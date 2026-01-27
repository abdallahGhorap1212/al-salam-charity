@extends('admin.layouts.app')

@section('title', 'إضافة خدمة')

@section('content')
    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="card border-0 shadow-sm p-4">
        @csrf
        @include('admin.services._form')
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">رجوع</a>
            <button type="submit" class="btn btn-primary">حفظ</button>
        </div>
    </form>
@endsection
