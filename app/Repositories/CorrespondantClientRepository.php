<?php

namespace App\Repositories;

use App\Models\CorrespondantClient;

class CorrespondantClientRepository
{
    public function create(array $data)
    {
        return CorrespondantClient::create($data);
    }
    public function getCorrespondantClientByIdClient($id)
    {
        return CorrespondantClient::where('idclient', $id)->with([
            // 'client', 
            'correspondant'
        ])->get();
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
}
