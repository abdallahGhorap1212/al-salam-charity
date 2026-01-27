@extends('admin.layouts.app')

@section('title', 'إضافة خبر')

@section('content')
    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="card border-0 shadow-sm p-4">
        @csrf
        @include('admin.news._form')
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary">رجوع</a>
            <button type="submit" class="btn btn-primary">حفظ</button>
        </div>
    </form>
@endsection
