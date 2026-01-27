@extends('admin.layouts.app')

@section('title', 'إضافة حالة')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.cases.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin.cases._form', ['areas' => $areas, 'caseTypes' => $caseTypes])
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                    <a href="{{ route('admin.cases.index') }}" class="btn btn-outline-secondary">رجوع</a>
                </div>
            </form>
        </div>
    </div>
@endsection
