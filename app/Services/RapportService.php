<?php

namespace App\Services;

use App\Repositories\RapportRepository;

class RapportService
{
    protected $rapportRepository;

    public function __construct(RapportRepository $rapportRepository)
    {
        $this->rapportRepository = $rapportRepository;
    }

    public function getAllRapports()
    {
        return $this->rapportRepository->all();
    }

    public function findRapport($id)
    {
        return $this->rapportRepository->find($id);
    }

    public function createRapport(array $data)
    {
        return $this->rapportRepository->create($data);
    }
}
