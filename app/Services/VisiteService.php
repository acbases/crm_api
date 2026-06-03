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

    public function updateVisite($id, array $data)
    {
        return $this->visiteRepository->update($id, $data);
    }

    public function findVisite($id)
    {
        return $this->visiteRepository->find($id);
    }

    public function getVisiteByIdClient($id)
    {
        return $this->visiteRepository->getVisiteByIdClient($id);
    }
    public function getVisiteByIdUtilisateur($id)
    {
        return $this->visiteRepository->getVisiteByIdUtilisateur($id);
    }
    public function getVisitesByIdClientAndIdUtilisateurAndStatutZero($idClient, $idUtilisateur)
    {
        return $this->visiteRepository->getVisitesByIdClientAndIdUtilisateurAndStatutZero($idClient, $idUtilisateur);
    }

    public function getViewVisiteDetailsByIdVisite($id)
    {
        return $this->visiteRepository->getViewVisiteDetailsByIdVisite($id);
    }
    public function getViewVisitePlvByIdVisite($id)
    {
        return $this->visiteRepository->getViewVisitePlvByIdVisite($id);
    }
}
