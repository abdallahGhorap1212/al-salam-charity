@extends('admin.layouts.app')

@section('title', 'تعديل خدمة')

@section('content')
    <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data" class="card border-0 shadow-sm p-4">
        @csrf
        @method('PUT')
        @include('admin.services._form', ['service' => $service])
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">رجوع</a>
            <button type="submit" class="btn btn-primary">تحديث</button>
        </div>
    </form>
@endsection
