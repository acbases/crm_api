<?php

namespace App\Repositories;

use App\Models\RefPrixProduit;

class RefPrixProduitRepository
{
    public function all()
    {
        return RefPrixProduit::with(['produitClient', 'visite'])->get();
    }

    public function find($id)
    {
        return RefPrixProduit::with(['produitClient', 'visite'])->find($id);
    }

    public function create(array $data)
    {
        return RefPrixProduit::create($data);
    }
}
