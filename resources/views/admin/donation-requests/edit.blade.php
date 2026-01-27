@extends('admin.layouts.app')

@section('title', 'تعديل حالة طلب التبرع')

@section('content')
    <form action="{{ route('admin.donation-requests.update', $donationRequest) }}" method="POST" class="card border-0 shadow-sm p-4">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">الحالة</label>
            <select name="status" class="form-select" required>
                @foreach (['pending' => 'جديد', 'contacted' => 'تم التواصل', 'completed' => 'مكتمل', 'cancelled' => 'ملغي'] as $value => $label)
                    <option value="{{ $value }}" @selected(old('status', $donationRequest->status) === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('admin.donation-requests.index') }}" class="btn btn-outline-secondary">رجوع</a>
            <button type="submit" class="btn btn-primary">تحديث</button>
        </div>
    </form>
@endsection
