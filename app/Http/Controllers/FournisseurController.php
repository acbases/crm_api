<?php

namespace App\Http\Controllers;

use App\Services\FournisseurService;

class FournisseurController extends Controller
{
    protected $fournisseurService;

    public function __construct(FournisseurService $fournisseurService)
    {
        $this->fournisseurService = $fournisseurService;
    }

    public function getAllFournisseurs()
    {
        return response()->json(
            $this->fournisseurService->all()
        );
    }

    public function getFournisseur($id)
    {
        return response()->json(
            $this->fournisseurService->find($id)
        );
    }
}
