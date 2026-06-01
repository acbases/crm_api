<?php

namespace App\Services;

use App\Repositories\VisiteStatutRepository;

class VisiteStatutService
{
    protected $visiteStatutRepository;

    public function __construct(VisiteStatutRepository $visiteStatutRepository)
    {
        $this->visiteStatutRepository = $visiteStatutRepository;
    }

    public function getVisitesByIdClientAndIdUtilisateurAndStatutZero($idClient, $idUtilisateur)
    {
        return $this->visiteStatutRepository->getVisitesByIdClientAndIdUtilisateurAndStatutZero($idClient, $idUtilisateur);
    }
}
