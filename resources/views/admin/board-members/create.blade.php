@extends('admin.layouts.app')

@section('title', 'إضافة عضو مجلس الإدارة')

@section('content')
    <form action="{{ route('admin.board-members.store') }}" method="POST" enctype="multipart/form-data" class="card border-0 shadow-sm p-4">
        @csrf
        @include('admin.board-members._form')
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('admin.board-members.index') }}" class="btn btn-outline-secondary">رجوع</a>
            <button type="submit" class="btn btn-primary">حفظ</button>
        </div>
    </form>
@endsection
