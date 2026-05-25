<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVisiteRequest;
use App\Services\VisiteService;

class VisiteController extends Controller
{
    protected $visiteService;

    public function __construct(VisiteService $visiteService)
    {
        $this->visiteService = $visiteService;
    }

    public function getAllVisites()
    {
    
        return response()->json(
            $this->visiteService->getAllVisites()
        );
    }

    public function createVisite(StoreVisiteRequest $request)
    {
        $visite = $this->visiteService->createVisite(
            $request->validated()
        );

        return response()->json($visite, 201);
    }
}
