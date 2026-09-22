<?php

namespace App\Services;

use App\Repositories\PlvStatsRepository;

class PlvStatsService
{
    protected $plvStatsRepository;

    public function __construct(PlvStatsRepository $plvStatsRepository)
    {
        $this->plvStatsRepository = $plvStatsRepository;
    }

    public function getPlvStats(?int $annee = null, ?int $mois = null): array
    {
        return array_merge(
            ['periode' => ['annee' => $annee, 'mois' => $mois]],
            $this->plvStatsRepository->getStats($annee, $mois)
        );
    }
}
