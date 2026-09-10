<?php

namespace App\Repositories;

use App\Models\FournisseurClient;

class FournisseurClientRepository
{
    public function create(array $data)
    {
        $data['statut'] = $data['statut'] ?? true;
        return FournisseurClient::create($data);
    }
    public function getFournisseurClientByIdClient($id)
    {
        return FournisseurClient::where('idclient', $id)
            ->where('statut', true)
            ->with([
                // 'client',
                'fournisseur'
            ])
            ->get();
    }

    public function all()
    {
        return FournisseurClient::where('statut', true)
            ->with(['fournisseur'])
            ->get();
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

    public function updateStatut($id)
    {
        $fournisseurClient = FournisseurClient::find($id);

        if (!$fournisseurClient) {
            return null;
        }

        $fournisseurClient->statut = false;
        $fournisseurClient->save();

        return $fournisseurClient;
    }
}
