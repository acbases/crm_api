<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreAgenceRequest;
use App\Services\AgenceService;

class AgenceController extends Controller
{
    protected $AgenceService;

    public function __construct(AgenceService $AgenceService)
    {
        $this->AgenceService = $AgenceService;
    }

    public function getAllAgences()
    {
        return response()->json(
            $this->AgenceService->getAllAgences()
        );
    }
    public function createAgence(StoreAgenceRequest $request)
    {
        $agence = $this->AgenceService->createAgence(
            $request->validated()
        );

        return response()->json($agence, 201);
    }
}
