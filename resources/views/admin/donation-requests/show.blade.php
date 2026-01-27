@extends('admin.layouts.app')

@section('title', 'تفاصيل طلب تبرع')

@section('content')
    <div class="card border-0 shadow-sm p-4">
        <h2 class="h5">{{ $donationRequest->name }}</h2>
        <p class="text-muted mb-1">الخدمة: {{ $donationRequest->service->title ?? 'تبرع عام' }}</p>
        <p class="text-muted mb-1">البريد: {{ $donationRequest->email ?? '-' }}</p>
        <p class="text-muted mb-1">الهاتف: {{ $donationRequest->phone ?? '-' }}</p>
        <p class="text-muted mb-3">المبلغ: {{ $donationRequest->amount ? number_format($donationRequest->amount, 2) : '-' }}</p>
        @if ($donationRequest->notes)
            <div class="border rounded p-3" style="white-space: pre-line;">{{ $donationRequest->notes }}</div>
        @endif
        <div class="mt-4 d-flex justify-content-end gap-2">
            <a href="{{ route('admin.donation-requests.index') }}" class="btn btn-outline-secondary">رجوع</a>
            @can('edit-donation-requests')
                <a href="{{ route('admin.donation-requests.edit', $donationRequest) }}" class="btn btn-outline-primary">تعديل الحالة</a>
            @endcan
        </div>
    </div>
@endsection
