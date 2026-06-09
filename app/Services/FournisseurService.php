<?php

namespace App\Services;

use App\Repositories\FournisseurRepository;

class FournisseurService
{
    protected $fournisseurRepository;

    public function __construct(FournisseurRepository $fournisseurRepository)
    {
        $this->fournisseurRepository = $fournisseurRepository;
    }

    public function all()
    {
        return $this->fournisseurRepository->all();
    }

    public function find($id)
    {
        return $this->fournisseurRepository->find($id);
    }

    public function createFournisseur(array $data)
    {
        return $this->fournisseurRepository->create($data);
    }
    public function updateFournisseur($id, array $data)
    {
        return $this->fournisseurRepository->update($id, $data);
    }
}
