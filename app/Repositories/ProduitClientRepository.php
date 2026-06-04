<?php

namespace App\Repositories;

use App\Models\ProduitClient;

class ProduitClientRepository
{
    public function all()
    {
        return ProduitClient::with(['client', 'produit', 'refPrixProduits'])->get();
    }

    public function find($id)
    {
        return ProduitClient::with(['client', 'produit', 'refPrixProduits'])->find($id);
    }

    public function create(array $data)
    {
        return ProduitClient::create($data);
    }
    public function getProduitClientByIdClient($id){
        return ProduitClient::where('idclient', $id)->get();
    }
}
