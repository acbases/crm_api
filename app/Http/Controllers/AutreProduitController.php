<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAutreProduitRequest;
use App\Services\AutreProduitService;

class AutreProduitController extends Controller
{
    protected $autreProduitService;

    public function __construct(AutreProduitService $autreProduitService)
    {
        $this->autreProduitService = $autreProduitService;
    }

    public function getAllAutreProduits()
    {
    
        return response()->json(
            $this->autreProduitService->getAllAutreProduits()
        );
    }

    public function createAutreProduit(StoreAutreProduitRequest $request)
    {
        $autreProduit = $this->autreProduitService->createAutreProduit(
            $request->validated()
        );

        return response()->json($autreProduit, 201);
    }
    public function findAutreProduit($id)
    {
        $autreProduit = $this->autreProduitService->findAutreProduit($id);

        if (!$autreProduit) {
            return response()->json([
                'message' => 'AutreProduit not found'
            ], 404);
        }

        return response()->json($autreProduit);
    }

}
