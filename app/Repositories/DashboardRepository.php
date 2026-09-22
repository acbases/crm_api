<?php

namespace App\Repositories;

use App\Models\AutreProduit;
use App\Models\Produit;
use App\Models\RefPrixProduit;
use App\Models\Visite;
use App\Repositories\Concerns\FiltrePeriode;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class DashboardRepository
{
    use FiltrePeriode;

    private const TYPES_PRIX = ['prix_achat', 'prix_vente_gros', 'prix_vente_details'];

    /**
     * Average price per price type, combining catalogue products (ref_prix_produit)
     * and "autres produits" (free-text products). Optionally restricted to a given
     * year and/or month, based on the date of the visite each price was recorded on.
     */
    public function getPrixMoyenParType(?int $annee = null, ?int $mois = null): array
    {
        $result = [];

        foreach (self::TYPES_PRIX as $type) {
            $catalogue = $this->filtrerParPeriode(
                RefPrixProduit::query()->join('visite', 'ref_prix_produit.idvisite', '=', 'visite.id'),
                'visite.date',
                $annee,
                $mois
            )->selectRaw("SUM(ref_prix_produit.$type) as somme, COUNT(ref_prix_produit.$type) as total")->first();

            $autres = $this->filtrerParPeriode(
                AutreProduit::query()->join('visite', 'autre_produit.idvisite', '=', 'visite.id'),
                'visite.date',
                $annee,
                $mois
            )->selectRaw("SUM(autre_produit.$type) as somme, COUNT(autre_produit.$type) as total")->first();

            $somme = (float) $catalogue->somme + (float) $autres->somme;
            $total = (int) $catalogue->total + (int) $autres->total;

            $result[$type] = $total > 0 ? round($somme / $total, 2) : null;
        }

        return $result;
    }

    /**
     * Sales ranking combining catalogue products (by produits.intitule) and "autres
     * produits" grouped by normalized name, so that 'Ciment', 'ciment', 'CIMENT' and
     * 'cIment' are counted as a single product instead of four low-volume ones.
     */
    public function getClassementProduits(?int $annee = null, ?int $mois = null): array
    {
        return $this->getClassementCatalogue($annee, $mois)
            ->concat($this->getClassementAutresProduits($annee, $mois))
            ->sortByDesc('volume_total')
            ->values()
            ->all();
    }

    /**
     * Market share (by sales volume) of "nos produits" (produits.statut = true) versus
     * "produits externes" (catalogue products with statut false/null, plus every "autre
     * produit", which are all external by definition).
     */
    public function getPartMarche(?int $annee = null, ?int $mois = null): array
    {
        $volumeNosProduits = (float) $this->requeteCatalogueParStatut(true, $annee, $mois)->sum('ref_prix_produit.volume');
        $volumeCatalogueExterne = (float) $this->requeteCatalogueParStatut(false, $annee, $mois)->sum('ref_prix_produit.volume');

        $volumeAutresProduits = (float) $this->filtrerParPeriode(
            AutreProduit::query()->join('visite', 'autre_produit.idvisite', '=', 'visite.id'),
            'visite.date',
            $annee,
            $mois
        )->sum('autre_produit.volume');

        $volumeProduitsExternes = $volumeCatalogueExterne + $volumeAutresProduits;
        $volumeTotal = $volumeNosProduits + $volumeProduitsExternes;

        return [
            'nos_produits' => [
                'volume' => $volumeNosProduits,
                'pourcentage' => $this->pourcentage($volumeNosProduits, $volumeTotal),
            ],
            'produits_externes' => [
                'volume' => $volumeProduitsExternes,
                'pourcentage' => $this->pourcentage($volumeProduitsExternes, $volumeTotal),
            ],
        ];
    }

    /**
     * Full detail for a single product: average price per type, average volume, and
     * the max/min of each price type and of volume, each naming the client whose
     * visite recorded that extreme value.
     *
     * $type is 'catalogue' (use $produitId, produits.id) or 'autre' (use $nom, matched
     * against autre_produit.nom after case/whitespace normalization). Returns null if
     * the product doesn't exist (catalogue) or has no data at all for the period (autre).
     */
    public function getDetailProduit(string $type, ?int $produitId, ?string $nom, ?int $annee, ?int $mois): ?array
    {
        if ($type === 'catalogue') {
            $produit = Produit::find($produitId);

            if (! $produit) {
                return null;
            }

            $lignes = $this->getLignesCatalogue($produitId, $annee, $mois);

            return array_merge([
                'type' => 'catalogue',
                'produit_id' => $produit->id,
                'nom' => $produit->intitule,
                'origine' => $produit->statut ? 'nos_produits' : 'externe',
            ], $this->calculerDetail($lignes));
        }

        $normalise = $this->normaliserNom($nom);
        $lignes = $this->getLignesAutres($annee, $mois)
            ->filter(fn ($ligne) => $this->normaliserNom($ligne->nom) === $normalise)
            ->values();

        if ($lignes->isEmpty()) {
            return null;
        }

        return array_merge([
            'type' => 'autre',
            'produit_id' => null,
            'nom' => $lignes->pluck('nom')->countBy()->sortDesc()->keys()->first(),
            'origine' => 'externe',
        ], $this->calculerDetail($lignes));
    }

    private function getLignesCatalogue(int $produitId, ?int $annee, ?int $mois): Collection
    {
        return $this->filtrerParPeriode(
            RefPrixProduit::query()
                ->join('produit_client', 'ref_prix_produit.idproduit', '=', 'produit_client.id')
                ->join('visite', 'ref_prix_produit.idvisite', '=', 'visite.id')
                ->join('client', 'visite.idclient', '=', 'client.id')
                ->where('produit_client.idproduit', $produitId),
            'visite.date',
            $annee,
            $mois
        )
            ->select(
                'ref_prix_produit.prix_achat',
                'ref_prix_produit.prix_vente_gros',
                'ref_prix_produit.prix_vente_details',
                'ref_prix_produit.volume',
                'client.id as client_id',
                'client.nom as client_nom'
            )
            ->get();
    }

    private function getLignesAutres(?int $annee, ?int $mois): Collection
    {
        return $this->filtrerParPeriode(
            AutreProduit::query()
                ->join('visite', 'autre_produit.idvisite', '=', 'visite.id')
                ->join('client', 'visite.idclient', '=', 'client.id'),
            'visite.date',
            $annee,
            $mois
        )
            ->select(
                'autre_produit.nom',
                'autre_produit.prix_achat',
                'autre_produit.prix_vente_gros',
                'autre_produit.prix_vente_details',
                'autre_produit.volume',
                'client.id as client_id',
                'client.nom as client_nom'
            )
            ->get();
    }

    /** Computes averages and, per field, the max/min value with the client it came from. */
    private function calculerDetail(Collection $lignes): array
    {
        return [
            'nb_occurrences' => $lignes->count(),
            'prix_moyen' => [
                'prix_achat' => $this->moyenne($lignes->pluck('prix_achat')),
                'prix_vente_gros' => $this->moyenne($lignes->pluck('prix_vente_gros')),
                'prix_vente_details' => $this->moyenne($lignes->pluck('prix_vente_details')),
            ],
            'volume_moyen' => $this->moyenne($lignes->pluck('volume')),
            'prix_max' => [
                'prix_achat' => $this->extreme($lignes, 'prix_achat', true),
                'prix_vente_gros' => $this->extreme($lignes, 'prix_vente_gros', true),
                'prix_vente_details' => $this->extreme($lignes, 'prix_vente_details', true),
            ],
            'prix_min' => [
                'prix_achat' => $this->extreme($lignes, 'prix_achat', false),
                'prix_vente_gros' => $this->extreme($lignes, 'prix_vente_gros', false),
                'prix_vente_details' => $this->extreme($lignes, 'prix_vente_details', false),
            ],
            'volume_max' => $this->extreme($lignes, 'volume', true),
            'volume_min' => $this->extreme($lignes, 'volume', false),
        ];
    }

    /** The max (or min) non-null value of $champ across $lignes, with its client. */
    private function extreme(Collection $lignes, string $champ, bool $max): ?array
    {
        $lignesAvecValeur = $lignes->filter(fn ($ligne) => $ligne->$champ !== null);

        if ($lignesAvecValeur->isEmpty()) {
            return null;
        }

        $ligne = $max
            ? $lignesAvecValeur->sortByDesc(fn ($l) => (float) $l->$champ)->first()
            : $lignesAvecValeur->sortBy(fn ($l) => (float) $l->$champ)->first();

        return [
            'valeur' => (float) $ligne->$champ,
            'client_id' => $ligne->client_id,
            'client' => $ligne->client_nom,
        ];
    }

    private function requeteCatalogueParStatut(bool $estNotre, ?int $annee, ?int $mois): Builder
    {
        $query = $this->filtrerParPeriode(
            RefPrixProduit::query()
                ->join('produit_client', 'ref_prix_produit.idproduit', '=', 'produit_client.id')
                ->join('produits', 'produit_client.idproduit', '=', 'produits.id')
                ->join('visite', 'ref_prix_produit.idvisite', '=', 'visite.id'),
            'visite.date',
            $annee,
            $mois
        );

        return $estNotre
            ? $query->where('produits.statut', true)
            : $query->where(function ($q) {
                $q->where('produits.statut', false)->orWhereNull('produits.statut');
            });
    }

    /**
     * All catalogue products, including those with no price ever recorded (volume 0,
     * null price averages) — left-joined from produits so none are silently dropped.
     */
    private function getClassementCatalogue(?int $annee, ?int $mois): Collection
    {
        $idsVisitePeriode = ($annee || $mois)
            ? Visite::query()
                ->when($annee, fn ($q) => $q->whereYear('date', $annee))
                ->when($mois, fn ($q) => $q->whereMonth('date', $mois))
                ->pluck('id')
                ->all()
            : null;

        return Produit::query()
            ->leftJoin('produit_client', 'produit_client.idproduit', '=', 'produits.id')
            ->leftJoin('ref_prix_produit', function ($join) use ($idsVisitePeriode) {
                $join->on('ref_prix_produit.idproduit', '=', 'produit_client.id');

                if ($idsVisitePeriode !== null) {
                    $join->whereIn('ref_prix_produit.idvisite', $idsVisitePeriode);
                }
            })
            ->selectRaw('
                produits.id as produit_id,
                produits.intitule as nom,
                produits.statut as statut,
                COALESCE(SUM(ref_prix_produit.volume), 0) as volume_total,
                AVG(ref_prix_produit.prix_achat) as prix_achat_moyen,
                AVG(ref_prix_produit.prix_vente_gros) as prix_vente_gros_moyen,
                AVG(ref_prix_produit.prix_vente_details) as prix_vente_details_moyen,
                COUNT(ref_prix_produit.id) as nb_occurrences
            ')
            ->groupBy('produits.id', 'produits.intitule', 'produits.statut')
            ->get()
            ->map(fn ($row) => [
                'type' => 'catalogue',
                'origine' => $row->statut ? 'nos_produits' : 'externe',
                'produit_id' => $row->produit_id,
                'nom' => $row->nom,
                'variantes' => [$row->nom],
                'volume_total' => (float) $row->volume_total,
                'prix_achat_moyen' => $this->arrondir($row->prix_achat_moyen),
                'prix_vente_gros_moyen' => $this->arrondir($row->prix_vente_gros_moyen),
                'prix_vente_details_moyen' => $this->arrondir($row->prix_vente_details_moyen),
                'nb_occurrences' => (int) $row->nb_occurrences,
            ]);
    }

    private function getClassementAutresProduits(?int $annee, ?int $mois): Collection
    {
        return $this->filtrerParPeriode(
            AutreProduit::query()->join('visite', 'autre_produit.idvisite', '=', 'visite.id'),
            'visite.date',
            $annee,
            $mois
        )
            ->select('autre_produit.*')
            ->get()
            ->groupBy(fn (AutreProduit $produit) => $this->normaliserNom($produit->nom))
            ->map(function (Collection $groupe) {
                $noms = $groupe->pluck('nom');
                $nomRepresentatif = $noms->countBy()->sortDesc()->keys()->first();

                return [
                    'type' => 'autre',
                    'origine' => 'externe',
                    'produit_id' => null,
                    'nom' => $nomRepresentatif,
                    'variantes' => $noms->unique()->values()->all(),
                    'volume_total' => (float) $groupe->sum('volume'),
                    'prix_achat_moyen' => $this->moyenne($groupe->pluck('prix_achat')),
                    'prix_vente_gros_moyen' => $this->moyenne($groupe->pluck('prix_vente_gros')),
                    'prix_vente_details_moyen' => $this->moyenne($groupe->pluck('prix_vente_details')),
                    'nb_occurrences' => $groupe->count(),
                ];
            })
            ->values();
    }

    /** Groups names that only differ by case or surrounding/repeated whitespace. */
    private function normaliserNom(string $nom): string
    {
        return mb_strtolower(trim(preg_replace('/\s+/', ' ', $nom)));
    }

    private function moyenne(Collection $valeurs): ?float
    {
        $valeurs = $valeurs->filter(fn ($v) => $v !== null);

        return $valeurs->isEmpty() ? null : round((float) $valeurs->avg(), 2);
    }

    private function arrondir($valeur): ?float
    {
        return $valeur !== null ? round((float) $valeur, 2) : null;
    }
}
