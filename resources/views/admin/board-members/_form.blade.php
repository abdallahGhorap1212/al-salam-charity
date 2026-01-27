@php
    $boardMember = $boardMember ?? null;
@endphp

<div class="mb-3">
    <label class="form-label">الاسم</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $boardMember->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">المنصب</label>
    <input type="text" name="role" class="form-control" value="{{ old('role', $boardMember->role ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">نبذة مختصرة</label>
    <textarea name="bio" class="form-control" rows="3">{{ old('bio', $boardMember->bio ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">رفع صورة</label>
    <input type="file" name="photo" class="form-control" accept="image/*">
</div>

@if (!empty($boardMember?->photo))
    <div class="mb-3 d-flex align-items-center gap-3">
        <div>
            <label class="form-check-label me-2" for="remove_photo">حذف الصورة الحالية</label>
            <input class="form-check-input" type="checkbox" name="remove_photo" id="remove_photo" value="1">
        </div>
        @if ($boardMember->photo_url)
            <img src="{{ $boardMember->photo_url }}" alt="{{ $boardMember->name }}" style="width:64px;height:64px;border-radius:12px;object-fit:cover;">
        @endif
    </div>
@endif

<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">الترتيب</label>
        <input type="number" name="sort_order" min="0" class="form-control" value="{{ old('sort_order', $boardMember->sort_order ?? 0) }}">
    </div>
    <div class="col-md-4 mb-3 d-flex align-items-end">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
                @checked(old('is_active', $boardMember->is_active ?? true))>
            <label class="form-check-label" for="is_active">نشط</label>
        </div>
    </div>
</div>
