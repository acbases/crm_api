<?php

namespace App\Repositories;

use App\Models\Visite;

class VisiteStatutRepository
{
    public function getVisitesByIdClientAndIdUtilisateurAndStatutZero($idClient, $idUtilisateur)
    {
        return Visite::where('idclient', $idClient)
            ->where('idutilisateur', $idUtilisateur)
            ->where('statut', 0)
            ->with([
                'client.categorieClient',
                'categorieVisite',
                'typeVisite',
            ])
            ->get();
    }
}
