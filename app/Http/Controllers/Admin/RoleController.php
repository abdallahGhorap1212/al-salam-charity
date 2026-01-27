<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleStoreRequest;
use App\Http\Requests\Admin\RoleUpdateRequest;
use App\Services\RoleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct(private readonly RoleService $roleService)
    {
        $this->middleware('auth');
        $this->middleware('permission:view-roles')->only(['index']);
        $this->middleware('permission:create-roles')->only(['create', 'store']);
        $this->middleware('permission:edit-roles')->only(['edit', 'update']);
        $this->middleware('permission:delete-roles')->only(['destroy']);
    }

    public function index(): View
    {
        $roles = $this->roleService->withPermissionsPaginated(15);

        return view('admin.roles.index', compact('roles'));
    }

    public function create(): View
    {
        $permissions = Permission::orderBy('name')->get();

        return view('admin.roles.create', compact('permissions'));
    }

    public function store(RoleStoreRequest $request): RedirectResponse
    {
        $this->roleService->create($request->validated());

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'تم إنشاء الدور بنجاح.');
    }

    public function show(string $id)
    {
        abort(404);
    }

    public function edit(Role $role): View
    {
        $permissions = Permission::orderBy('name')->get();
        $rolePermissionNames = $role->permissions->pluck('name')->toArray();

        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissionNames'));
    }

    public function update(RoleUpdateRequest $request, Role $role): RedirectResponse
    {
        $this->roleService->update($role, $request->validated());

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'تم تحديث الدور.');
    }

    public function destroy(Role $role): RedirectResponse
    {
        if (in_array($role->name, ['Admin'])) {
            return redirect()
                ->route('admin.roles.index')
                ->with('success', 'لا يمكن حذف دور المدير.');
        }

        $this->roleService->delete($role);

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'تم حذف الدور.');
    }
}
