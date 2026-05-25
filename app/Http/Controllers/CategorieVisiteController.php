<?php

namespace App\Http\Controllers;

use App\Services\CategorieVisiteService;

class CategorieVisiteController extends Controller
{
    protected $CategorieVisiteService;

    public function __construct(CategorieVisiteService $CategorieVisiteService)
    {
        $this->CategorieVisiteService = $CategorieVisiteService;
    }

    public function getAllCategorieVisites()
    {
        return response()->json(
            $this->CategorieVisiteService->getAllCategorieVisites()
        );
    }
}
