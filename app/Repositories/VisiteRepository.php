<?php

namespace App\Repositories;

use App\Models\Visite;

class VisiteRepository
{
    public function all()
    {
        return Visite::all();
    }

    public function find($id)
    {
        return Visite::with([
            'client.categorieClient', 
            'categorieVisite',
            'typeVisite'
            ])->find($id);
    }

    public function create(array $data)
    {
        return Visite::create($data);
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
    
}
