<?php

namespace App\Repositories\Eloquent;

use Spatie\Permission\Models\Role;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class RoleRepository extends BaseRepository
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    public function withPermissionsPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->query()->with('permissions')->orderBy('name')->paginate($perPage);
    }
}
