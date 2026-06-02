<?php

namespace App\Services;

use App\Repositories\AutreProduitRepository;

class AutreProduitService
{
    protected $autreProduitRepository;

    public function __construct(AutreProduitRepository $autreProduitRepository)
    {
        $this->autreProduitRepository = $autreProduitRepository;
    }

    public function getAllAutreProduits()
    {
        return $this->autreProduitRepository->all();
    }

    public function createAutreProduit(array $data)
    {
        return $this->autreProduitRepository->create($data);
    }

    public function findAutreProduit($id)
    {
        return $this->autreProduitRepository->find($id);
    }
}
