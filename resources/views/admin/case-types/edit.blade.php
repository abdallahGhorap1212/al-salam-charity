@extends('admin.layouts.app')

@section('title', 'تعديل نوع حالة')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.case-types.update', $caseType) }}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.case-types._form', ['caseType' => $caseType])
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">تحديث</button>
                    <a href="{{ route('admin.case-types.index') }}" class="btn btn-outline-secondary">رجوع</a>
                </div>
            </form>
        </div>
    </div>
@endsection
