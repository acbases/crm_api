<?php

namespace App\Services;

use App\Repositories\DashboardRepository;

class DashboardService
{
    protected $dashboardRepository;

    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function getProduitStats(?int $limit = null, ?int $annee = null, ?int $mois = null, ?int $agenceId = null): array
    {
        $classement = $this->dashboardRepository->getClassementProduits($annee, $mois, $agenceId);

        return [
            'periode' => ['annee' => $annee, 'mois' => $mois, 'agence_id' => $agenceId],
            'prix_moyen_par_type' => $this->dashboardRepository->getPrixMoyenParType($annee, $mois, $agenceId),
            'meilleur_produit' => $classement[0] ?? null,
            'produits' => $limit ? array_slice($classement, 0, $limit) : $classement,
            'part_marche' => $this->dashboardRepository->getPartMarche($annee, $mois, $agenceId),
        ];
    }

    public function getProduitDetail(string $type, ?int $produitId, ?string $nom, ?int $annee = null, ?int $mois = null, ?int $agenceId = null): ?array
    {
        $detail = $this->dashboardRepository->getDetailProduit($type, $produitId, $nom, $annee, $mois, $agenceId);

        return $detail ? array_merge(['periode' => ['annee' => $annee, 'mois' => $mois, 'agence_id' => $agenceId]], $detail) : null;
    }
}
