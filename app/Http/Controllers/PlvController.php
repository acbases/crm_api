<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlvRequest;
use App\Services\PlvService;

class PlvController extends Controller
{
    protected $plvService;

    public function __construct(PlvService $plvService)
    {
        $this->plvService = $plvService;
    }

    public function getAllPlvs()
    {
        return response()->json(
            $this->plvService->getAllPlvs()
        );
    }

    public function findPlv($id)
    {
        $plv = $this->plvService->findPlv($id);

        if (! $plv) {
            return response()->json([
                'message' => 'Plv not found',
            ], 404);
        }

        return response()->json($plv);
    }

    public function createPlv(StorePlvRequest $request)
    {
        $plv = $this->plvService->createPlv(
            $request->validated()
        );

        return response()->json($plv, 201);
    }
}
