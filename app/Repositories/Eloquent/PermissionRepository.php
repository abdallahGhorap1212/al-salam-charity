<?php

namespace App\Repositories\Eloquent;

use Spatie\Permission\Models\Permission;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PermissionRepository extends BaseRepository
{
    public function __construct(Permission $model)
    {
        parent::__construct($model);
    }

    public function orderedPaginated(int $perPage = 20): LengthAwarePaginator
    {
        return $this->query()->orderBy('name')->paginate($perPage);
    }
}
