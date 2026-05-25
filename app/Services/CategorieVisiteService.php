<?php

namespace App\Services;

use App\Repositories\CategorieVisiteRepository;

class CategorieVisiteService
{
    protected $CategorieVisiteRepository;

    public function __construct(CategorieVisiteRepository $CategorieVisiteRepository)
    {
        $this->CategorieVisiteRepository = $CategorieVisiteRepository;
    }

    public function getAllCategorieVisites()
    {
        return $this->CategorieVisiteRepository->all();
    }
}
