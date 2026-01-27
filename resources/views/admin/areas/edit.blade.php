@extends('admin.layouts.app')

@section('title', 'تعديل منطقة')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.areas.update', $area) }}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.areas._form', ['area' => $area])
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">تحديث</button>
                    <a href="{{ route('admin.areas.index') }}" class="btn btn-outline-secondary">رجوع</a>
                </div>
            </form>
        </div>
    </div>
@endsection
