@extends('admin.layouts.app')

@section('title', 'روابط التواصل الاجتماعي')

@section('content')
<div class="card">
    <div class="card-header bg-info text-white">
        <i class="bi bi-share"></i> روابط التواصل الاجتماعي
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.settings.social.update') }}">
            @csrf
            <div class="row g-4">
                @foreach($social as $key => $value)
                <div class="col-md-6 col-lg-4">
                    <label class="form-label">{{ $key }}</label>
                    <input type="text" name="social[{{ $key }}]" value="{{ $value }}" class="form-control">
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
