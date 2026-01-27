<?php

namespace App\Services;

use App\Models\About;
use App\Repositories\Eloquent\AboutRepository;

class AboutService
{
    public function __construct(private readonly AboutRepository $aboutRepository)
    {
    }

    public function getOrCreate(): About
    {
        return $this->aboutRepository->firstOrCreate();
    }

    public function update(array $data): About
    {
        $about = $this->aboutRepository->firstOrCreate();
        $this->aboutRepository->update($about, $data);

        return $about;
    }
}
