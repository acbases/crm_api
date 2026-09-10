<?php

namespace App\Repositories;

use App\Models\CorrespondantClient;

class CorrespondantClientRepository
{
    public function create(array $data)
    {
        $data['statut'] = $data['statut'] ?? true;
        return CorrespondantClient::create($data);
    }

    public function getCorrespondantClientByIdClient($id)
    {
        return CorrespondantClient::where('idclient', $id)
            ->where('statut', true)
            ->with([
                // 'client',
                'correspondant'
            ])
            ->get();
    }

    public function all()
    {
        return CorrespondantClient::where('statut', true)
            ->with(['correspondant'])
            ->get();
    }
    public function find($id)
    {
        return CorrespondantClient::find($id);
    }
    public function delete($id)
    {
        $correspondantClient = CorrespondantClient::find($id);

        if ($correspondantClient) {
            return $correspondantClient->delete();
        }
        return false;
    }

    public function updateStatut($id)
    {
        $correspondantClient = CorrespondantClient::find($id);

        if (!$correspondantClient) {
            return null;
        }

        $correspondantClient->statut = false;
        $correspondantClient->save();

        return $correspondantClient;
    }
}
