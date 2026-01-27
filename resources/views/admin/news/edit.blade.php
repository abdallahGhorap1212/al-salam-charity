@extends('admin.layouts.app')

@section('title', 'تعديل خبر')

@section('content')
    <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data" class="card border-0 shadow-sm p-4">
        @csrf
        @method('PUT')
        @include('admin.news._form', ['news' => $news])
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary">رجوع</a>
            <button type="submit" class="btn btn-primary">تحديث</button>
        </div>
    </form>
@endsection
