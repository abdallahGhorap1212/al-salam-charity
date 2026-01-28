@extends('admin.layouts.app')

@section('title', 'معلومات الجمعية')

@section('content')
<div class="card">
    <div class="card-header bg-success text-white">
        <i class="bi bi-building"></i> معلومات الجمعية
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.settings.organization.update') }}">
            @csrf
            <div class="row g-4">
                @foreach($organization as $key => $value)
                <div class="col-md-6 col-lg-4">
                    <label class="form-label">{{ $key }}</label>
                    <input type="text" name="organization[{{ $key }}]" value="{{ $value }}" class="form-control">
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
