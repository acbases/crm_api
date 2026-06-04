<?php

namespace App\Services;

use App\Repositories\ProduitClientRepository;

class ProduitClientService
{
    protected $produitClientRepository;

    public function __construct(ProduitClientRepository $produitClientRepository)
    {
        $this->produitClientRepository = $produitClientRepository;
    }

    public function getAllProduitClients()
    {
        return $this->produitClientRepository->all();
    }

    public function createProduitClient(array $data)
    {
        return $this->produitClientRepository->create($data);
    }

    public function findProduitClient($id)
    {
        return $this->produitClientRepository->find($id);
    }
    public function getProduitClientByIdClient($id)
    {
        return $this->produitClientRepository->getProduitClientByIdClient($id);
    }

}
