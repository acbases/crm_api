<?php

namespace App\Repositories;

use App\Models\Client;

class ClientRepository
{
    public function all()
    {
        return Client::with(['agence', 'categorieClient'])->get();
    }

    public function find($id)
    {
        return Client::with(['agence', 'categorieClient'])->find($id);
    }

    public function create(array $data)
    {
        return Client::create($data);
    }
    public function update($id, array $data)
    {
        $client = Client::find($id);

        if (!$client) {
            return null;
        }

        $client->update($data);
//         {
//     "nom": "ClientTest",
//     "latitude": 2.12121200,
//     "longitude": 2.25255000,
//     "zone": "Rn7",
//     "quartier": "Ambohimanarina",
//     "idagence": 2,
//     "idcategorie": 14,
//     "status_qrcode": true
// }
        return $client->fresh();
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


}
