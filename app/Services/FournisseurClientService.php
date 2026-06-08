<?php

namespace App\Services;

use App\Repositories\FournisseurClientRepository;

class FournisseurClientService
{
    protected $fournisseurClientRepository;

    public function __construct(FournisseurClientRepository $fournisseurClientRepository)
    {
        $this->fournisseurClientRepository = $fournisseurClientRepository;
    }

    public function create(array $data)
    {
        return $this->fournisseurClientRepository->create($data);
    }
    public function getFournisseurClientByIdClient($id)
    {
        return $this->fournisseurClientRepository->getFournisseurClientByIdClient($id);
    }
}
