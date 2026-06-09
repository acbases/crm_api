<?php

namespace App\Repositories;

use App\Models\FournisseurClient;

class FournisseurClientRepository
{
    public function create(array $data)
    {
        return FournisseurClient::create($data);
    }
    public function getFournisseurClientByIdClient($id)
    {
        return FournisseurClient::where('idclient', $id)->with([
            // 'client', 
            'fournisseur'
        ])->get();
    }

    public function find($id)
    {
        return FournisseurClient::find($id);
    }
    public function delete($id)
    {
        $fournisseurClient = FournisseurClient::find($id);

        if ($fournisseurClient) {
            return $fournisseurClient->delete();
        }
        return false;
    }
}
