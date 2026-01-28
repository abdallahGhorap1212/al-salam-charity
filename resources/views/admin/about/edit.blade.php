@extends('admin.layouts.app')

@section('title', 'نبذة عن الجمعية')

@section('content')
    <form action="{{ route('admin.about.update') }}" method="POST" class="card border-0 shadow-sm p-4">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-6 mb-3">
                <label class="form-label">اسم الجمعية</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $about->title ?? '') }}" required>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="form-label">عنوان فرعي</label>
                <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $about->subtitle ?? '') }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">نبذة مختصرة</label>
            <textarea name="summary" class="form-control" rows="3">{{ old('summary', $about->summary ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">تفاصيل الجمعية</label>
            <textarea name="body" class="form-control" rows="6">{{ old('body', $about->body ?? '') }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">الرسالة</label>
                <input type="text" name="mission" class="form-control" value="{{ old('mission', $about->mission ?? '') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">الرؤية</label>
                <input type="text" name="vision" class="form-control" value="{{ old('vision', $about->vision ?? '') }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">العنوان</label>
                <input type="text" name="address" class="form-control" value="{{ old('address', $about->address ?? '') }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">الهاتف</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $about->phone ?? '') }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">البريد الإلكتروني</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $about->email ?? '') }}">
            </div>
        </div>

        <hr class="my-4">
        <h5 class="mb-3">روابط التواصل الاجتماعي</h5>
        <div class="row g-3 align-items-end">
            @php
                $icons = [
                    'facebook' => 'facebook',
                    'twitter' => 'twitter',
                    'instagram' => 'instagram',
                    'linkedin' => 'linkedin',
                    'youtube' => 'youtube',
                    'whatsapp' => 'whatsapp',
                ]; 
                $labels = [
                    'facebook' => 'فيسبوك',
                    'twitter' => 'تويتر',
                    'instagram' => 'انستجرام',
                    'linkedin' => 'لينكدإن',
                    'youtube' => 'يوتيوب',
                    'whatsapp' => 'واتساب',
                ];
            @endphp
            @foreach($social as $key => $value)
                <div class="col-md-4 mb-2">
                    <label class="form-label"><i class="bi bi-{{ $icons[$key] }} me-1"></i> {{ $labels[$key] }}</label>
                    <input type="text" name="social[{{ $key }}]" class="form-control" value="{{ old('social.'.$key, $value) }}">
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-end gap-2 mt-4">
            <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
        </div>
    </form>

    <div class="mt-4">
        <h6>روابط التواصل الاجتماعي الفعالة:</h6>
        <div class="d-flex flex-wrap gap-3">
            @foreach($social as $key => $value)
                @if($value && trim($value) !== '')
                    <a href="{{ $key === 'whatsapp' ? 'https://wa.me/' . $value : $value }}" target="_blank" class="btn btn-outline-{{ $key == 'whatsapp' ? 'success' : ($key == 'facebook' ? 'primary' : ($key == 'twitter' ? 'info' : ($key == 'youtube' ? 'danger' : 'dark'))) }} d-flex align-items-center gap-2">
                        <i class="bi bi-{{ $icons[$key] }} fs-4"></i> {{ $labels[$key] }}
                    </a>
                @endif
            @endforeach
        </div>
    </div>
@endsection
