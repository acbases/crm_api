<?php

namespace App\Http\Controllers;

use App\Services\TypeVisiteService;

class TypeVisiteController extends Controller
{
    protected $TypeVisiteService;

    public function __construct(TypeVisiteService $TypeVisiteService)
    {
        $this->TypeVisiteService = $TypeVisiteService;
    }

    public function getAllTypeVisites()
    {
        return response()->json(
            $this->TypeVisiteService->getAllTypeVisites()
        );
    }
}