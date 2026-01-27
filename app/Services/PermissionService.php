<?php

namespace App\Services;

use App\Repositories\Eloquent\PermissionRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Spatie\Permission\Models\Permission;

class PermissionService
{
    public function __construct(private readonly PermissionRepository $permissionRepository)
    {
    }

    public function orderedPaginated(int $perPage = 20): LengthAwarePaginator
    {
        return $this->permissionRepository->orderedPaginated($perPage);
    }

    public function create(array $data): Permission
    {
        return $this->permissionRepository->create(['name' => $data['name']]);
    }

    public function update(Permission $permission, array $data): bool
    {
        return $this->permissionRepository->update($permission, ['name' => $data['name']]);
    }

    public function delete(Permission $permission): bool
    {
        return $this->permissionRepository->delete($permission);
    }
}
