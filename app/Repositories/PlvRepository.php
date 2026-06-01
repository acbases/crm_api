<?php

namespace App\Repositories;

use App\Models\Plv;

class PlvRepository
{
    public function all()
    {
        return Plv::get();
    }

    public function find($id)
    {
        return Plv::find($id);
    }

    public function create(array $data)
    {
        return Plv::create($data);
    }
}
