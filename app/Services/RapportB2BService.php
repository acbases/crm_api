<?php

namespace App\Services;

use App\Repositories\RapportB2BRepository;

class RapportB2BService
{
    protected $rapportB2BRepository;

    public function __construct(RapportB2BRepository $rapportB2BRepository)
    {
        $this->rapportB2BRepository = $rapportB2BRepository;
    }

    public function getAllRapportB2B()
    {
        return $this->rapportB2BRepository->all();
    }

    public function createRapportB2B(array $data)
    {
        return $this->rapportB2BRepository->create($data);
    }
    public function findRapportB2B($id)
    {
        return $this->rapportB2BRepository->find($id);
    }

}