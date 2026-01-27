@extends('admin.layouts.app')

@section('title', 'إضافة مستخدم')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                @include('admin.users._form', ['roles' => $roles])
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">رجوع</a>
                </div>
            </form>
        </div>
    </div>
@endsection
