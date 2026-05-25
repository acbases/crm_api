<?php

namespace App\Services;

use App\Repositories\VisiteRepository;

class VisiteService
{
    protected $visiteRepository;

    public function __construct(VisiteRepository $visiteRepository)
    {
        $this->visiteRepository = $visiteRepository;
    }

    public function getAllVisites()
    {
        return $this->visiteRepository->all();
    }

    public function createVisite(array $data)
    {
        return $this->visiteRepository->create($data);
    }
}