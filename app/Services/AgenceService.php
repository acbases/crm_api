<?php

namespace App\Services;

use App\Repositories\AgenceRepository;

class AgenceService
{
    protected $AgenceRepository;

    public function __construct(AgenceRepository $AgenceRepository)
    {
        $this->AgenceRepository = $AgenceRepository;
    }

    public function getAllAgences()
    {
        return $this->AgenceRepository->all();
    }

    public function createAgence(array $data)
    {
        return $this->AgenceRepository->create($data);
    }
}
