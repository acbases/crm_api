<?php

namespace App\Repositories;

use App\Models\CorrespondantClient;

class CorrespondantClientRepository
{
    public function create(array $data)
    {
        return CorrespondantClient::create($data);
    }

}
