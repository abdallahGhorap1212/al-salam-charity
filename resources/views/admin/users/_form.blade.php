@php
    $user = $user ?? null;
    $userRoleNames = $userRoleNames ?? [];
@endphp

<div class="mb-3">
    <label class="form-label">الاسم</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">البريد الإلكتروني</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">كلمة المرور {{ $user ? '(اتركها فارغة إن لم ترغب بالتغيير)' : '' }}</label>
    <input type="password" name="password" class="form-control" {{ $user ? '' : 'required' }}>
</div>

<div class="mb-3">
    <label class="form-label">تأكيد كلمة المرور</label>
    <input type="password" name="password_confirmation" class="form-control" {{ $user ? '' : 'required' }}>
</div>

<div class="mb-3">
    <label class="form-label">الأدوار</label>
    <div class="d-flex flex-wrap gap-2">
        @forelse ($roles as $role)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->name }}" id="role_{{ $role->id }}"
                    @checked(in_array($role->name, old('roles', $userRoleNames)))>
                <label class="form-check-label" for="role_{{ $role->id }}">
                    {{ $role->name }}
                </label>
            </div>
        @empty
            <span class="text-muted">لا توجد أدوار بعد.</span>
        @endforelse
    </div>
</div>
