<?php

namespace App\Repositories;

use App\Models\Client;

class ClientRepository
{
    public function all()
    {
        return Client::all();
    }

    public function find($id)
    {
        return Client::with(['agence', 'categorie'])->find($id);
    }

    public function create(array $data)
    {
        return Client::create($data);
    }
}
