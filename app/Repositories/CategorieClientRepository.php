<?php

namespace App\Repositories;

use App\Models\CategorieClient;

class CategorieClientRepository
{
    public function all()
    {
        return CategorieClient::all();
    }

    public function find($id)
    {
        return CategorieClient::find($id);
    }

    public function create(array $data)
    {
        return CategorieClient::create($data);
    }
}