@extends('admin.layouts.app')

@section('title', 'تعديل دور')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.roles.update', $role) }}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.roles._form', ['role' => $role, 'permissions' => $permissions, 'rolePermissionNames' => $rolePermissionNames])
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">تحديث</button>
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">رجوع</a>
                </div>
            </form>
        </div>
    </div>
@endsection
