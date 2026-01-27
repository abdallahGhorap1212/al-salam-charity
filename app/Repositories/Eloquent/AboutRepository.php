<?php

namespace App\Repositories\Eloquent;

use App\Models\About;

class AboutRepository extends BaseRepository
{
    public function __construct(About $model)
    {
        parent::__construct($model);
    }

    public function firstOrCreate(): About
    {
        return $this->query()->firstOrCreate([]);
    }
}
