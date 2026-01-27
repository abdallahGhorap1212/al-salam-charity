@extends('admin.layouts.app')

@section('title', 'تعديل صلاحية')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.permissions.update', $permission) }}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.permissions._form', ['permission' => $permission])
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">تحديث</button>
                    <a href="{{ route('admin.permissions.index') }}" class="btn btn-outline-secondary">رجوع</a>
                </div>
            </form>
        </div>
    </div>
@endsection
