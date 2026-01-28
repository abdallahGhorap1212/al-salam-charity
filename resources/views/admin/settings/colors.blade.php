@extends('admin.layouts.app')

@section('title', 'إعدادات الألوان')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <i class="bi bi-palette"></i> إعدادات الألوان
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.settings.colors.update') }}">
            @csrf
            <div class="row g-4">
                @foreach($colors as $key => $color)
                <div class="col-md-6 col-lg-3">
                    <label class="form-label">{{ $key }}</label>
                    <input type="color" name="colors[{{ $key }}]" value="{{ $color }}" class="form-control form-control-color" style="width: 100%; height: 3rem;">
                </div>
                @endforeach
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-success px-5">حفظ التغييرات</button>
                <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary">رجوع</a>
            </div>
        </form>
    </div>
</div>
@endsection
