<?php

namespace App\Repositories;

use App\Models\Rapport;
use App\Models\RecensementPlv;
use App\Repositories\Concerns\FiltrePeriode;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class PlvStatsRepository
{
    use FiltrePeriode;

    /**
     * PLV stats for a given period, restricted to "retail" visits (client.idcategorie
     * -> categorie_client.statut = 'RETAIL'; B2B visits use a separate report flow with
     * no PLV survey). Reports how many field visits were reported, how many of them
     * recorded at least one PLV, a ranking of catalogue PLV by field presence, and a
     * tally of the free-text "autre_plv" field recorded on the visit report.
     */
    public function getStats(?int $annee = null, ?int $mois = null, ?int $agenceId = null): array
    {
        $totalVisitesAvecRapport = $this->restreindreAuxVisitesRetail($this->filtrerParPeriode(
            Rapport::query()->join('visite', 'rapport.idvisite', '=', 'visite.id'),
            'visite.date',
            $annee,
            $mois
        ), $agenceId)->distinct('rapport.idvisite')->count('rapport.idvisite');

        $classement = $this->getClassementPlv($annee, $mois, $agenceId, $totalVisitesAvecRapport);

        $totalVisitesAvecPlv = $this->restreindreAuxVisitesRetail($this->filtrerParPeriode(
            RecensementPlv::query()->join('visite', 'recensement_plv.idvisite', '=', 'visite.id'),
            'visite.date',
            $annee,
            $mois
        ), $agenceId)->distinct('recensement_plv.idvisite')->count('recensement_plv.idvisite');

        return [
            'total_visites_avec_rapport' => $totalVisitesAvecRapport,
            'total_visites_avec_plv' => $totalVisitesAvecPlv,
            'taux_presence_global' => $this->pourcentage($totalVisitesAvecPlv, $totalVisitesAvecRapport),
            'plv_le_plus_present' => $classement[0] ?? null,
            'classement_plv' => $classement,
            'autre_plv' => $this->getAutrePlv($annee, $mois, $agenceId),
        ];
    }

    private function getClassementPlv(?int $annee, ?int $mois, ?int $agenceId, int $totalVisitesAvecRapport): array
    {
        return $this->restreindreAuxVisitesRetail($this->filtrerParPeriode(
            RecensementPlv::query()
                ->join('plv', 'recensement_plv.idplv', '=', 'plv.id')
                ->join('visite', 'recensement_plv.idvisite', '=', 'visite.id'),
            'visite.date',
            $annee,
            $mois
        ), $agenceId)
            ->selectRaw('
                plv.id as plv_id,
                plv.nom as nom,
                COUNT(*) as nb_recensements,
                COUNT(DISTINCT recensement_plv.idvisite) as nb_visites
            ')
            ->groupBy('plv.id', 'plv.nom')
            ->get()
            ->map(fn ($row) => [
                'plv_id' => $row->plv_id,
                'nom' => $row->nom,
                'nb_recensements' => (int) $row->nb_recensements,
                'nb_visites' => (int) $row->nb_visites,
                'taux_presence' => $this->pourcentage((float) $row->nb_visites, (float) $totalVisitesAvecRapport),
            ])
            ->sortByDesc('nb_visites')
            ->values()
            ->all();
    }

    /** Tally of the free-text "autre_plv" field, grouped by case/whitespace-normalized value. */
    private function getAutrePlv(?int $annee, ?int $mois, ?int $agenceId): array
    {
        return $this->restreindreAuxVisitesRetail($this->filtrerParPeriode(
            Rapport::query()->join('visite', 'rapport.idvisite', '=', 'visite.id'),
            'visite.date',
            $annee,
            $mois
        ), $agenceId)
            ->whereNotNull('rapport.autre_plv')
            ->where('rapport.autre_plv', '!=', '')
            ->pluck('rapport.autre_plv')
            ->groupBy(fn (string $valeur) => $this->normaliser($valeur))
            ->map(fn (Collection $groupe) => [
                'valeur' => $groupe->countBy()->sortDesc()->keys()->first(),
                'variantes' => $groupe->unique()->values()->all(),
                'nb_occurrences' => $groupe->count(),
            ])
            ->sortByDesc('nb_occurrences')
            ->values()
            ->all();
    }

    /**
     * Restricts a query (which must already join 'visite') to visits made at retail
     * clients, i.e. client.idcategorie -> categorie_client.statut = 'RETAIL'. B2B
     * clients (categorie_client.statut = 'B2B') report through a separate flow
     * (rapportb2b) that has no PLV survey, so they're excluded here rather than
     * showing up as false "no PLV" data points.
     */
    private function restreindreAuxVisitesRetail(Builder $query, ?int $agenceId = null): Builder
    {
        $query = $query
            ->join('client', 'visite.idclient', '=', 'client.id')
            ->join('categorie_client', 'client.idcategorie', '=', 'categorie_client.id')
            ->where('categorie_client.statut', 'RETAIL');

        return $this->filtrerParAgence($query, $agenceId, clientDejaJoint: true);
    }

    /** Groups values that only differ by case or surrounding/repeated whitespace. */
    private function normaliser(string $valeur): string
    {
        return mb_strtolower(trim(preg_replace('/\s+/', ' ', $valeur)));
    }
}
