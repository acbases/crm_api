<?php

namespace App\Http\Controllers;

use App\Services\CategorieClientService;

class CategorieClientController extends Controller
{
    protected $CategorieClientService;

    public function __construct(CategorieClientService $CategorieClientService)
    {
        $this->CategorieClientService = $CategorieClientService;
    }

    public function getAllCategorieClients()
    {
    
        return response()->json(
            $this->CategorieClientService->getAllCategorieClients()
        );
    }
}
