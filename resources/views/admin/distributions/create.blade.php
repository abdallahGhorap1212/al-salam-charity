@extends('admin.layouts.app')

@section('title', 'تسجيل استلام')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            @if (session('previous_distribution'))
                <div class="alert alert-warning">
                    تم صرف هذه الحالة من قبل بتاريخ
                    <strong>{{ session('previous_distribution.date') }}</strong>
                    للمستفيد
                    <strong>{{ session('previous_distribution.case_name') }}</strong>.
                    هل تريد الاستمرار؟
                    <form action="{{ route('admin.distributions.store') }}" method="POST" class="mt-2 d-flex gap-2 flex-wrap">
                        @csrf
                        <input type="hidden" name="barcode" value="{{ old('barcode') }}">
                        <input type="hidden" name="notes" value="{{ old('notes') }}">
                        <input type="hidden" name="confirm_override" value="1">
                        <button type="submit" class="btn btn-sm btn-primary">نعم، سجل الصرف</button>
                        <a href="{{ route('admin.distributions.index') }}" class="btn btn-sm btn-outline-secondary">إلغاء</a>
                    </form>
                </div>
            @endif
            <form action="{{ route('admin.distributions.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">امسح الباركود</label>
                    <input type="text" name="barcode" class="form-control" value="{{ old('barcode') }}" autofocus required>
                </div>
                <div class="mb-3">
                    <label class="form-label">ملاحظات</label>
                    <textarea name="notes" class="form-control" rows="3">{{ old('notes') }}</textarea>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">تسجيل</button>
                    <a href="{{ route('admin.distributions.index') }}" class="btn btn-outline-secondary">رجوع</a>
                </div>
            </form>
        </div>
    </div>
@endsection
