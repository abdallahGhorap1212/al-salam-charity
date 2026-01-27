@extends('admin.layouts.app')

@section('title', 'تفاصيل الخبر')

@section('content')
    <div class="card border-0 shadow-sm p-4">
        <h2 class="h4">{{ $news->title }}</h2>
        <p class="text-muted">{{ optional($news->published_at)->format('Y-m-d H:i') ?? 'غير محدد' }}</p>
        @if ($news->cover_image_url)
            <img src="{{ $news->cover_image_url }}" alt="{{ $news->title }}" class="img-fluid rounded mb-3">
        @endif
        @if ($news->excerpt)
            <p class="lead">{{ $news->excerpt }}</p>
        @endif
        <div class="news-body">{!! \App\Support\HtmlSanitizer::clean($news->body) !!}</div>
        @if ($news->images->count())
            <div class="mt-4 d-flex flex-wrap gap-3">
                @foreach ($news->images as $image)
                    <img src="{{ $image->url }}" alt="{{ $news->title }}" class="img-fluid rounded" style="width:140px;height:90px;object-fit:cover;">
                @endforeach
            </div>
        @endif
        <div class="mt-4">
            <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary">رجوع</a>
        </div>
    </div>
@endsection
