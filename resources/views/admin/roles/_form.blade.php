@php
    $role = $role ?? null;
    $rolePermissionNames = $rolePermissionNames ?? [];
@endphp

<div class="mb-3">
    <label class="form-label">اسم الدور</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $role->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">الصلاحيات</label>
    <div class="row">
        @forelse ($permissions as $permission)
            <div class="col-md-4">
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                           id="perm_{{ $permission->id }}"
                           @checked(in_array($permission->name, old('permissions', $rolePermissionNames)))>
                    <label class="form-check-label" for="perm_{{ $permission->id }}">
                        {{ $permission->name }}
                    </label>
                </div>
            </div>
        @empty
            <div class="col-12 text-muted">لا توجد صلاحيات بعد.</div>
        @endforelse
    </div>
</div>
