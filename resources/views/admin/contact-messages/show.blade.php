@extends('admin.layouts.app')

@section('title', 'تفاصيل رسالة')

@section('content')
    <div class="card border-0 shadow-sm p-4">
        <h2 class="h5">{{ $contactMessage->subject ?? 'رسالة جديدة' }}</h2>
        <p class="text-muted mb-1">الاسم: {{ $contactMessage->name }}</p>
        <p class="text-muted mb-1">البريد: {{ $contactMessage->email ?? '-' }}</p>
        <p class="text-muted mb-3">الهاتف: {{ $contactMessage->phone ?? '-' }}</p>
        <div class="border rounded p-3" style="white-space: pre-line;">{{ $contactMessage->message }}</div>
        <div class="mt-4 d-flex justify-content-end gap-2">
            <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-outline-secondary">رجوع</a>
            @can('delete-contact-messages')
                <form action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" method="POST"
                      onsubmit="return confirm('هل تريد حذف الرسالة؟');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">حذف</button>
                </form>
            @endcan
        </div>
    </div>
@endsection
