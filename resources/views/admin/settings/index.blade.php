@extends('admin.layouts.app')

@section('title', 'إعدادات الموقع')

@section('content')
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <i class="bi bi-sliders"></i> إعدادات الموقع
    </div>
    <div class="card-body">
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <a href="{{ route('admin.settings.colors') }}" class="btn btn-outline-primary w-100 py-4 d-flex flex-column align-items-center gap-2">
                    <i class="bi bi-palette fs-2"></i>
                    <span>إعدادات الألوان</span>
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="{{ route('admin.settings.social') }}" class="btn btn-outline-info w-100 py-4 d-flex flex-column align-items-center gap-2">
                    <i class="bi bi-share fs-2"></i>
                    <span>روابط التواصل الاجتماعي</span>
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="{{ route('admin.settings.organization') }}" class="btn btn-outline-success w-100 py-4 d-flex flex-column align-items-center gap-2">
                    <i class="bi bi-building fs-2"></i>
                    <span>معلومات الجمعية</span>
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="{{ route('admin.settings.content') }}" class="btn btn-outline-warning w-100 py-4 d-flex flex-column align-items-center gap-2">
                    <i class="bi bi-card-text fs-2"></i>
                    <span>النصوص الثابتة</span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-light">
        <i class="bi bi-list"></i> جميع الإعدادات (للمراجعة فقط)
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>الفئة</th>
                        <th>المفتاح</th>
                        <th>القيمة</th>
                        <th>الوصف</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($settings as $category => $items)
                    @foreach($items as $key => $setting)
                        <tr>
                            <td>{{ $category }}</td>
                            <td>{{ $key }}</td>
                            <td>{{ is_array($setting['value']) ? json_encode($setting['value'], JSON_UNESCAPED_UNICODE) : $setting['value'] }}</td>
                            <td>{{ $setting['description'] ?? '' }}</td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
