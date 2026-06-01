<?php

namespace App\Services;

use App\Repositories\RefPrixProduitRepository;

class RefPrixProduitService
{
    protected $refPrixProduitRepository;

    public function __construct(RefPrixProduitRepository $refPrixProduitRepository)
    {
        $this->refPrixProduitRepository = $refPrixProduitRepository;
    }

    public function getAllRefPrixProduits()
    {
        return $this->refPrixProduitRepository->all();
    }

    public function findRefPrixProduit($id)
    {
        return $this->refPrixProduitRepository->find($id);
    }

    public function createRefPrixProduit(array $data)
    {
        return $this->refPrixProduitRepository->create($data);
    }
}
