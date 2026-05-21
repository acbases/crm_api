<?php

namespace App\Services;

use App\Repositories\CategorieClientRepository;

class CategorieClientService
{
    protected $CategorieClientRepository;

    public function __construct(CategorieClientRepository $CategorieClientRepository)
    {
        $this->CategorieClientRepository = $CategorieClientRepository;
    }

    public function getAllCategorieClients()
    {
        return $this->CategorieClientRepository->all();
    }

    public function createCategorieClient(array $data)
    {
        return $this->CategorieClientRepository->create($data);
    }
}