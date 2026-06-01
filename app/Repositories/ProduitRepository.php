<?php

namespace App\Repositories;

use App\Models\Produit;

class ProduitRepository
{
    public function all()
    {
        return Produit::all();
    }

    public function find($id)
    {
        return Produit::find($id);
    }

    public function create(array $data)
    {
        return Produit::create($data);
    }
}
