<?php

namespace App\Repositories\Eloquent;

use App\Models\CaseType;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CaseTypeRepository extends BaseRepository
{
    public function __construct(CaseType $model)
    {
        parent::__construct($model);
    }

    public function orderedPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->query()->orderBy('name')->paginate($perPage);
    }

    public function orderedAll(): Collection
    {
        return $this->query()->orderBy('name')->get();
    }
}
