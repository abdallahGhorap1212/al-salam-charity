@php
    $news = $news ?? null;
@endphp

<div class="mb-3">
    <label class="form-label">عنوان الخبر</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $news->title ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">الرابط المختصر</label>
    <input type="text" name="slug" class="form-control" value="{{ old('slug', $news->slug ?? '') }}">
    <div class="form-text">يُترك فارغًا لتوليد رابط تلقائي.</div>
</div>

<div class="mb-3">
    <label class="form-label">نبذة مختصرة</label>
    <textarea name="excerpt" class="form-control" rows="3">{{ old('excerpt', $news->excerpt ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">نص الخبر</label>
    <div class="wysiwyg" data-wysiwyg>
        <div class="wysiwyg-toolbar">
            <button type="button" class="btn btn-sm btn-outline-secondary" data-command="bold">غامق</button>
            <button type="button" class="btn btn-sm btn-outline-secondary" data-command="italic">مائل</button>
            <button type="button" class="btn btn-sm btn-outline-secondary" data-command="underline">تحته خط</button>
            <button type="button" class="btn btn-sm btn-outline-secondary" data-command="h2">عنوان</button>
            <button type="button" class="btn btn-sm btn-outline-secondary" data-command="h3">عنوان فرعي</button>
            <button type="button" class="btn btn-sm btn-outline-secondary" data-command="p">نص عادي</button>
            <button type="button" class="btn btn-sm btn-outline-secondary" data-command="ul">قائمة</button>
            <button type="button" class="btn btn-sm btn-outline-secondary" data-command="ol">ترقيم</button>
            <button type="button" class="btn btn-sm btn-outline-secondary" data-command="link">رابط</button>
        </div>
        <div class="wysiwyg-editor" contenteditable="true" data-wysiwyg-editor></div>
        <textarea name="body" class="form-control d-none" rows="10" required data-wysiwyg-input>{{ old('body', $news->body ?? '') }}</textarea>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">عنوان الراعي (اختياري)</label>
        <input type="text" name="sponsor_title" class="form-control" value="{{ old('sponsor_title', $news->sponsor_title ?? '') }}">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">رابط الراعي</label>
        <input type="text" name="sponsor_link" class="form-control" value="{{ old('sponsor_link', $news->sponsor_link ?? '') }}">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">نص الراعي</label>
        <input type="text" name="sponsor_body" class="form-control" value="{{ old('sponsor_body', $news->sponsor_body ?? '') }}">
    </div>
</div>

<div class="mb-3">
    <label class="form-label">صورة الغلاف</label>
    <input type="file" name="cover_image" class="form-control" accept="image/*">
    @if (!empty($news?->cover_image_url))
        <div class="mt-2 d-flex align-items-center gap-3">
            <img src="{{ $news->cover_image_url }}" alt="{{ $news->title }}" style="width:120px;height:80px;border-radius:10px;object-fit:cover;">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remove_cover_image" id="remove_cover_image" value="1">
                <label class="form-check-label" for="remove_cover_image">حذف صورة الغلاف</label>
            </div>
        </div>
    @endif
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">تاريخ النشر</label>
        <input type="datetime-local" name="published_at" class="form-control"
               value="{{ old('published_at', optional($news->published_at ?? null)->format('Y-m-d\TH:i')) }}">
    </div>
    <div class="col-md-6 mb-3 d-flex align-items-end">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="is_published" id="is_published" value="1"
                @checked(old('is_published', $news->is_published ?? true))>
            <label class="form-check-label" for="is_published">نشر الخبر</label>
        </div>
    </div>
</div>

<div class="mb-3">
    <label class="form-label">صور داخل الخبر (متعددة)</label>
    <input type="file" name="gallery[]" class="form-control" accept="image/*" multiple>
</div>

@if (!empty($news?->images) && $news->images->count())
    <div class="mb-3">
        <div class="d-flex flex-wrap gap-3">
            @foreach ($news->images as $image)
                <label class="d-flex flex-column align-items-center gap-2">
                    <img src="{{ $image->url }}" alt="{{ $news->title }}" style="width:120px;height:80px;border-radius:10px;object-fit:cover;">
                    <span class="form-check">
                        <input class="form-check-input" type="checkbox" name="remove_gallery[]" value="{{ $image->id }}">
                        <small class="text-muted">حذف</small>
                    </span>
                </label>
            @endforeach
        </div>
    </div>
@endif
