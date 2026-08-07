<?php

namespace App\Repositories;

use App\Models\AllproRh;

class AllproRhRepository
{
    public function getEligibleCommerciaux()
    {
        return AllproRh::query()
            // ->where('direction', 'Direction Commerciale')
            ->where('statut_crm', true)
            ->get();
    }
}
