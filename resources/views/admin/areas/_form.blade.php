@php
    $area = $area ?? null;
@endphp

<div class="mb-3">
    <label class="form-label">اسم المنطقة</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $area->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">الكود</label>
    <input type="text" name="code" class="form-control" value="{{ old('code', $area->code ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">الوصف</label>
    <textarea name="description" class="form-control" rows="3">{{ old('description', $area->description ?? '') }}</textarea>
</div>

<div class="form-check mb-3">
    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
        @checked(old('is_active', $area->is_active ?? true))>
    <label class="form-check-label" for="is_active">
        نشط
    </label>
</div>
