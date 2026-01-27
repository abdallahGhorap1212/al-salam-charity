<?php

namespace App\Services;

use App\Repositories\Eloquent\RoleRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Spatie\Permission\Models\Role;

class RoleService
{
    public function __construct(private readonly RoleRepository $roleRepository)
    {
    }

    public function withPermissionsPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->roleRepository->withPermissionsPaginated($perPage);
    }

    public function create(array $data): Role
    {
        $role = $this->roleRepository->create(['name' => $data['name']]);
        $role->syncPermissions($data['permissions'] ?? []);

        return $role;
    }

    public function update(Role $role, array $data): bool
    {
        $this->roleRepository->update($role, ['name' => $data['name']]);
        $role->syncPermissions($data['permissions'] ?? []);

        return true;
    }

    public function delete(Role $role): bool
    {
        return $this->roleRepository->delete($role);
    }
}
