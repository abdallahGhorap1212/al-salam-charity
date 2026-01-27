@extends('admin.layouts.app')

@section('title', 'تفاصيل الخدمة')

@section('content')
    <div class="card border-0 shadow-sm p-4">
        <h2 class="h4">{{ $service->title }}</h2>
        @if ($service->summary)
            <p class="lead">{{ $service->summary }}</p>
        @endif
        @if ($service->icon_url)
            <img src="{{ $service->icon_url }}" alt="{{ $service->title }}" class="img-fluid rounded mb-3" style="max-width:120px;">
        @endif
        @if ($service->description)
            <div class="text-muted" style="white-space: pre-line;">{{ $service->description }}</div>
        @endif
        <div class="mt-4">
            <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">رجوع</a>
        </div>
    </div>
@endsection
