@php
    $case = $case ?? null;
@endphp

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">رقم الحالة (اختياري)</label>
            <input type="text" name="case_number" class="form-control" value="{{ old('case_number', $case->case_number ?? '') }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">اسم المستفيد</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $case->name ?? '') }}" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">الرقم القومي</label>
            <input type="text" name="national_id" class="form-control" value="{{ old('national_id', $case->national_id ?? '') }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">رقم الهاتف</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $case->phone ?? '') }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">عدد أفراد الأسرة</label>
            <input type="number" name="family_members_count" class="form-control" min="1" value="{{ old('family_members_count', $case->family_members_count ?? '') }}">
        </div>
    </div>
</div>

<div class="mb-3">
    <label class="form-label">العنوان</label>
    <textarea name="address" class="form-control" rows="2">{{ old('address', $case->address ?? '') }}</textarea>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">المنطقة</label>
            <select name="area_id" class="form-select" required>
                <option value="">اختر المنطقة</option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}" @selected(old('area_id', $case->area_id ?? '') == $area->id)>
                        {{ $area->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">نوع الحالة</label>
            <select name="case_type_id" class="form-select" required>
                <option value="">اختر النوع</option>
                @foreach ($caseTypes as $type)
                    <option value="{{ $type->id }}" @selected(old('case_type_id', $case->case_type_id ?? '') == $type->id)>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="mb-3">
    <label class="form-label">ملاحظات</label>
    <textarea name="notes" class="form-control" rows="3">{{ old('notes', $case->notes ?? '') }}</textarea>
</div>

<div class="form-check mb-3">
    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
        @checked(old('is_active', $case->is_active ?? true))>
    <label class="form-check-label" for="is_active">
        نشطة
    </label>
</div>

<div class="mb-3">
    <label class="form-label">ملفات الحالة</label>
    <input class="form-control" type="file" name="files[]" multiple>
    <div class="form-text">يمكن رفع أكثر من ملف (حتى 5MB لكل ملف).</div>
</div>

@if ($case && $case->files->isNotEmpty())
    <div class="mb-3">
        <label class="form-label">الملفات الحالية</label>
        <ul class="list-unstyled">
            @foreach ($case->files as $file)
                <li class="mb-1">
                    <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">{{ $file->file_name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endif
