<?php

namespace App\Repositories;

use App\Models\Visite;
use App\Models\ViewVisiteDetails;
use App\Models\ViewVisitePlv;

class VisiteRepository
{
    public function all()
    {
        return Visite::with([
            'client.categorieClient', 
            'categorieVisite',
            'typeVisite',
            'utilisateur'
            ])->get();
    }

    public function find($id)
    {
        return Visite::with([
            'client.categorieClient', 
            'categorieVisite',
            'typeVisite',
            'utilisateur'
            ])->find($id);
    }

    public function create(array $data)
    {
        return Visite::create($data);
    }

    public function update($id, array $data)
    {
        $visite = Visite::find($id);

        if (! $visite) {
            return null;
        }

        $visite->update($data);

        // return $visite->fresh([
        //     'client.categorieClient',
        //     'categorieVisite',
        //     'typeVisite',
        // ]);
        return $visite->fresh();
    }

    public function getVisiteByIdClient($id){
        return Visite::where('idclient', $id)->with([
            'client.categorieClient', 
            'categorieVisite', 
            'typeVisite'
            ])->get();
    }
    public function getVisiteByIdUtilisateur($id){
        return Visite::where('idutilisateur', $id)->with([
            'client.categorieClient', 
            'categorieVisite',
            'typeVisite'
            ])->get();
    }
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
    public function getViewVisiteDetailsByIdVisite($id)
    {
        // 2. Query the view model just like a regular table
        return ViewVisiteDetails::where('id_visite', $id)->get();
    }
    public function getViewVisitePlvByIdVisite($id)
    {
        // 2. Query the view model just like a regular table
        return ViewVisitePlv::where('id_visite', $id)->get();
    }
}
