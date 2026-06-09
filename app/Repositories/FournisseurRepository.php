<?php

namespace App\Repositories;

use App\Models\Fournisseur;

class FournisseurRepository
{
    public function all()
    {
        return Fournisseur::all();
    }

    public function find($id)
    {
        return Fournisseur::find($id);
    }

    public function create(array $data)
    {
        return Fournisseur::create($data);
    }
    public function update($id, array $data){
        $fournisseur = Fournisseur::find($id);
        if(! $fournisseur){
            return null;
        }
        $fournisseur->update($data);
        return $fournisseur->fresh();
    }
    
}
