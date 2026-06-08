<?php

namespace App\Http\Controllers;

use App\Services\FournisseurClientService;
use Illuminate\Http\Request;

class FournisseurClientController extends Controller
{
    protected $fournisseurClientService;

    public function __construct(FournisseurClientService $fournisseurClientService)
    {
        $this->fournisseurClientService = $fournisseurClientService;
    }

    public function createFournisseurClient(Request $request)
    {
        $fournisseurClient = $this->fournisseurClientService->create(
            $request->all()
        );

        return response()->json($fournisseurClient, 201);
    }
    public function getFournisseurClientByIdClient($id)
    {
        $fournisseurClients = $this->fournisseurClientService->getFournisseurClientByIdClient($id);

        if ($fournisseurClients->isEmpty()) {
            return response()->json([
                'message' => 'No fournisseur clients found for this client',
            ], 404);
        }
        return response()->json($fournisseurClients, 200);
    }
    public function getFournisseurClientById($id)
    {
        return response()->json(
            $this->fournisseurClientService->find($id)
        );
    }

    
}
