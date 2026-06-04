<?php

namespace App\Repositories;

use App\Models\Rapport;
use App\Models\VueRapportProduits;
use App\Models\VueRapportPlv;
use App\Models\VueRapportAutresProduits;

class RapportRepository
{
    public function all()
    {
        return Rapport::with('visite')->get();
    }

    public function find($id)
    {
        return Rapport::with('visite')->find($id);
    }

    public function create(array $data)
    {
        return Rapport::create($data);
    }
    public function getVueRapportProduitsByIdVisite($id)
    {
        // 2. Query the view model just like a regular table
        return VueRapportProduits::where('idvisite', $id)->get();
    }
    public function getVueRapportAutresProduitsByIdVisite($id)
    {
        // 2. Query the view model just like a regular table
        return VueRapportAutresProduits::where('idvisite', $id)->get();
    }
    public function getVueRapportPlvByIdVisite($id)
    {
        // 2. Query the view model just like a regular table
        return VueRapportPlv::where('idvisite', $id)->get();
    }
}
