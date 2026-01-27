@extends('admin.layouts.app')

@section('title', 'تعديل عضو مجلس الإدارة')

@section('content')
    <form action="{{ route('admin.board-members.update', $boardMember) }}" method="POST" enctype="multipart/form-data" class="card border-0 shadow-sm p-4">
        @csrf
        @method('PUT')
        @include('admin.board-members._form', ['boardMember' => $boardMember])
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('admin.board-members.index') }}" class="btn btn-outline-secondary">رجوع</a>
            <button type="submit" class="btn btn-primary">تحديث</button>
        </div>
    </form>
@endsection
