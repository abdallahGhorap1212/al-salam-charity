@php
    $service = $service ?? null;
@endphp

<div class="mb-3">
    <label class="form-label">اسم الخدمة</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $service->title ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">الرابط المختصر</label>
    <input type="text" name="slug" class="form-control" value="{{ old('slug', $service->slug ?? '') }}">
    <div class="form-text">يُترك فارغًا لتوليد رابط تلقائي.</div>
</div>

<div class="mb-3">
    <label class="form-label">وصف مختصر</label>
    <textarea name="summary" class="form-control" rows="3">{{ old('summary', $service->summary ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">التفاصيل</label>
    <textarea name="description" class="form-control" rows="6">{{ old('description', $service->description ?? '') }}</textarea>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">صورة الخدمة</label>
        <input type="file" name="icon" class="form-control" accept="image/*">
        @if (!empty($service?->icon_url))
            <div class="mt-2">
                <img src="{{ $service->icon_url }}" alt="{{ $service->title }}" style="width:64px;height:64px;border-radius:12px;object-fit:cover;">
            </div>
        @endif
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">الترتيب</label>
        <input type="number" name="sort_order" min="0" class="form-control" value="{{ old('sort_order', $service->sort_order ?? 0) }}">
    </div>
    <div class="col-md-4 mb-3 d-flex align-items-end">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
                @checked(old('is_active', $service->is_active ?? true))>
            <label class="form-check-label" for="is_active">نشط</label>
        </div>
    </div>
</div>
