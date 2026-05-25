<?php

namespace App\Repositories;

use App\Models\CategorieVisite;

class CategorieVisiteRepository
{
    public function all()
    {
        return CategorieVisite::all();
    }
}
