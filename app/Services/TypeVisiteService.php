<?php

namespace App\Services;

use App\Repositories\TypeVisiteRepository;

class TypeVisiteService
{
    protected $TypeVisiteRepository;

    public function __construct(TypeVisiteRepository $TypeVisiteRepository)
    {
        $this->TypeVisiteRepository = $TypeVisiteRepository;
    }

    public function getAllTypeVisites()
    {
        return $this->TypeVisiteRepository->all();
    }

    public function createTypeVisite(array $data)
    {
        return $this->TypeVisiteRepository->create($data);
    }
}
