<?php

namespace App\Http\Controllers;

use App\Services\ProduitClientService;
use Illuminate\Http\Request;

class ProduitClientController extends Controller
{
    protected $produitClientService;

    public function __construct(ProduitClientService $produitClientService)
    {
        $this->produitClientService = $produitClientService;
    }

    public function getAllProduitClients()
    {
        return response()->json(
            $this->produitClientService->getAllProduitClients()
        );
    }

    public function createProduitClient(Request $request)
    {
        $produitClient = $this->produitClientService->createProduitClient(
            $request->all()
        );

        return response()->json($produitClient, 201);
    }

    public function findProduitClient($id)
    {
        $produitClient = $this->produitClientService->findProduitClient($id);

        if (!$produitClient) {
            return response()->json([
                'message' => 'ProduitClient not found'
            ], 404);
        }

        return response()->json($produitClient);
    }
}
