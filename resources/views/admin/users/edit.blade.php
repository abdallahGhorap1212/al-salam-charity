@extends('admin.layouts.app')

@section('title', 'تعديل مستخدم')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.users._form', ['user' => $user, 'roles' => $roles, 'userRoleNames' => $userRoleNames])
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">تحديث</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">رجوع</a>
                </div>
            </form>
        </div>
    </div>
@endsection
