<?php

namespace App\Services;

use App\Repositories\ProduitRepository;

class ProduitService
{
    protected $produitRepository;

    public function __construct(ProduitRepository $produitRepository)
    {
        $this->produitRepository = $produitRepository;
    }

    public function getAllProduits()
    {
        return $this->produitRepository->all();
    }

    public function findProduit($id)
    {
        return $this->produitRepository->find($id);
    }

    public function createProduit(array $data)
    {
        return $this->produitRepository->create($data);
    }
}
