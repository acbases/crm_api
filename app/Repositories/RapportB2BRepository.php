<?php

namespace App\Repositories;

use App\Models\Client;

class RapportB2BRepository
{
    public function all()
    {
        return RapportB2B::all();
    }

    public function find($id)
    {
        return RapportB2B::with(['visite', 'correspondant'])->find($id);
    }

    public function create(array $data)
    {
        return Client::create($data);
    }
}
