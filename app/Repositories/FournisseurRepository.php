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
}
