<?php

namespace App\Services;

use App\Repositories\PlvRepository;

class PlvService
{
    protected $plvRepository;

    public function __construct(PlvRepository $plvRepository)
    {
        $this->plvRepository = $plvRepository;
    }

    public function getAllPlvs()
    {
        return $this->plvRepository->all();
    }

    public function findPlv($id)
    {
        return $this->plvRepository->find($id);
    }

    public function createPlv(array $data)
    {
        return $this->plvRepository->create($data);
    }
}
