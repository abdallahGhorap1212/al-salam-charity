@php
    $permission = $permission ?? null;
@endphp

<div class="mb-3">
    <label class="form-label">اسم الصلاحية</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $permission->name ?? '') }}" required>
</div>
