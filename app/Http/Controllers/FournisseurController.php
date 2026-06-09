<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FournisseurService;
use App\Http\Requests\UpdateFournisseurRequest;

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

    public function createFournisseur(Request $request)
    {
        $data = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
        ]);

        $fournisseur = $this->fournisseurService->createFournisseur($data);

        return response()->json($fournisseur, 201);
    }
    public function updateFournisseur($id, UpdateFournisseurRequest $request)
    {
        $data = $request->validated();

        $fournisseur = $this->fournisseurService->updateFournisseur($id, $data);

        return response()->json($fournisseur);
    }
}
