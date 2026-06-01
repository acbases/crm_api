<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecensementPlvRequest;
use App\Services\RecensementPlvService;

class RecensementPlvController extends Controller
{
    protected $recensementPlvService;

    public function __construct(RecensementPlvService $recensementPlvService)
    {
        $this->recensementPlvService = $recensementPlvService;
    }

    public function getAllRecensementPlv()
    {
        return response()->json(
            $this->recensementPlvService->getAllRecensementPlv()
        );
    }

    public function findRecensementPlv($id)
    {
        $recensementPlv = $this->recensementPlvService->findRecensementPlv($id);

        if (! $recensementPlv) {
            return response()->json([
                'message' => 'RecensementPlv not found',
            ], 404);
        }

        return response()->json($recensementPlv);
    }

    public function createRecensementPlv(StoreRecensementPlvRequest $request)
    {
        $recensementPlv = $this->recensementPlvService->createRecensementPlv(
            $request->validated()
        );

        return response()->json($recensementPlv, 201);
    }
}
