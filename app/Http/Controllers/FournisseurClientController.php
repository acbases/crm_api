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

    
}
