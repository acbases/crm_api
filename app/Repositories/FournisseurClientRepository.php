<?php

namespace App\Repositories;

use App\Models\FournisseurClient;

class FournisseurClientRepository
{
    public function create(array $data)
    {
        return FournisseurClient::create($data);
    }
}
