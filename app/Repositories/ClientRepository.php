<?php

namespace App\Repositories;

use App\Models\Client;

class ClientRepository
{
    public function all()
    {
        return Client::with(['agence', 'categorieClient'])->get();
    }

    public function getClientsActif()
    {
        return Client::with(['agence', 'categorieClient'])->where('statut', true)->get();
    }

    public function find($id)
    {
        return Client::with(['agence', 'categorieClient'])->find($id);
    }

    public function create(array $data)
    {
        $data['status'] = $data['status'] ?? true;

        return Client::create($data);
    }
    
    public function update($id, array $data)
    {
        $client = Client::find($id);

        try {
            $client->update($data);

            return $client->fresh();
        } catch (\Throwable $e) {
            dd([
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
        }
    }
    public function getUniqueZones()
    {
        return Client::query()
            ->select('zone')
            ->whereNotNull('zone')
            ->distinct()
            ->orderBy('zone')
            ->pluck('zone');
    }
    public function getUniqueQuartiers()
    {
        return Client::query()
            ->select('quartier')
            ->whereNotNull('quartier')
            ->distinct()
            ->orderBy('quartier')
            ->pluck('quartier');
    }

    public function updateStatut($id)
    {
        $client = Client::find($id);

        if (!$client) {
            return null;
        }

        $client->statut = false;
        $client->save();

        return $client;
    }

}
