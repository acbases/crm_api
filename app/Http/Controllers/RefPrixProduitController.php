<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRefPrixProduitRequest;
use App\Services\RefPrixProduitService;

class RefPrixProduitController extends Controller
{
    protected $refPrixProduitService;

    public function __construct(RefPrixProduitService $refPrixProduitService)
    {
        $this->refPrixProduitService = $refPrixProduitService;
    }

    public function getAllRefPrixProduits()
    {
        return response()->json(
            $this->refPrixProduitService->getAllRefPrixProduits()
        );
    }

    public function findRefPrixProduit($id)
    {
        $refPrixProduit = $this->refPrixProduitService->findRefPrixProduit($id);

        if (! $refPrixProduit) {
            return response()->json([
                'message' => 'RefPrixProduit not found',
            ], 404);
        }

        return response()->json($refPrixProduit);
    }

    public function createRefPrixProduit(StoreRefPrixProduitRequest $request)
    {
        $refPrixProduit = $this->refPrixProduitService->createRefPrixProduit(
            $request->validated()
        );

        return response()->json($refPrixProduit, 201);
    }
}
