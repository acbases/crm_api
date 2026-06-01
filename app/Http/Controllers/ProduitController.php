<?php

namespace App\Http\Controllers;

use App\Services\ProduitService;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    protected $produitService;

    public function __construct(ProduitService $produitService)
    {
        $this->produitService = $produitService;
    }

    public function getAllProduits()
    {
        return response()->json(
            $this->produitService->getAllProduits()
        );
    }

    public function findProduit($id)
    {
        $produit = $this->produitService->findProduit($id);

        if (! $produit) {
            return response()->json([
                'message' => 'Produit not found',
            ], 404);
        }

        return response()->json($produit);
    }

    public function createProduit(Request $request)
    {
        $produit = $this->produitService->createProduit(
            $request->only(['intitule', 'statut'])
        );

        return response()->json($produit, 201);
    }
}
