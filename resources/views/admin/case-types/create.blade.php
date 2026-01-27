@extends('admin.layouts.app')

@section('title', 'إضافة نوع حالة')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.case-types.store') }}" method="POST">
                @csrf
                @include('admin.case-types._form')
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                    <a href="{{ route('admin.case-types.index') }}" class="btn btn-outline-secondary">رجوع</a>
                </div>
            </form>
        </div>
    </div>
@endsection
