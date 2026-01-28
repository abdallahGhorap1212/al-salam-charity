@extends('admin.layouts.app')

@section('title', 'النصوص الثابتة')

@section('content')
<div class="card">
    <div class="card-header bg-warning">
        <i class="bi bi-card-text"></i> النصوص الثابتة
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.settings.content.update') }}">
            @csrf
            <div class="row g-4">
                @foreach($content as $key => $value)
                <div class="col-md-6 col-lg-6">
                    <label class="form-label">{{ $key }}</label>
                    <textarea name="content[{{ $key }}]" class="form-control" rows="2">{{ $value }}</textarea>
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
