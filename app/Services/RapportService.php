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
    public function getVueRapportProduitsByIdVisite($id)
    {
        return $this->rapportRepository->getVueRapportProduitsByIdVisite($id);
    }
    public function getVueRapportAutresProduitsByIdVisite($id)
    {
        return $this->rapportRepository->getVueRapportAutresProduitsByIdVisite($id);
    }
    public function getVueRapportPlvByIdVisite($id)
    {
        return $this->rapportRepository->getVueRapportPlvByIdVisite($id);
    }
}
