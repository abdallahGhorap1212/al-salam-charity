<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PermissionStoreRequest;
use App\Http\Requests\Admin\PermissionUpdateRequest;
use App\Services\PermissionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct(private readonly PermissionService $permissionService)
    {
        $this->middleware('auth');
        $this->middleware('permission:view-roles')->only(['index']);
        $this->middleware('permission:create-roles')->only(['create', 'store']);
        $this->middleware('permission:edit-roles')->only(['edit', 'update']);
        $this->middleware('permission:delete-roles')->only(['destroy']);
    }

    public function index(): View
    {
        $permissions = $this->permissionService->orderedPaginated(20);

        return view('admin.permissions.index', compact('permissions'));
    }

    public function create(): View
    {
        return view('admin.permissions.create');
    }

    public function store(PermissionStoreRequest $request): RedirectResponse
    {
        $this->permissionService->create($request->validated());

        return redirect()
            ->route('admin.permissions.index')
            ->with('success', 'تم إنشاء الصلاحية بنجاح.');
    }

    public function edit(Permission $permission): View
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(PermissionUpdateRequest $request, Permission $permission): RedirectResponse
    {
        $this->permissionService->update($permission, $request->validated());

        return redirect()
            ->route('admin.permissions.index')
            ->with('success', 'تم تحديث الصلاحية.');
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        $this->permissionService->delete($permission);

        return redirect()
            ->route('admin.permissions.index')
            ->with('success', 'تم حذف الصلاحية.');
    }
}
