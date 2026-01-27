@extends('admin.layouts.app')

@section('title', 'تعديل حالة')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.cases.update', $case) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.cases._form', ['case' => $case, 'areas' => $areas, 'caseTypes' => $caseTypes])
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">تحديث</button>
                    <a href="{{ route('admin.cases.index') }}" class="btn btn-outline-secondary">رجوع</a>
                </div>
            </form>
        </div>
    </div>
@endsection
