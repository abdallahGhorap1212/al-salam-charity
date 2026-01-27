@extends('site.layouts.app')

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1>{{ $news->title }}</h1>
            <p>{{ optional($news->published_at)->format('Y-m-d') ?? $news->created_at->format('Y-m-d') }}</p>
        </div>
    </section>

    <section class="section-block">
        <div class="container">
            <div class="content-card">
                <div class="content-main">
                    @if ($news->cover_image_url)
                        <img src="{{ $news->cover_image_url }}" alt="{{ $news->title }}" class="content-image">
                    @endif
                    @if ($news->excerpt)
                        <p class="lead">{{ $news->excerpt }}</p>
                    @endif
                    <div class="news-body">{!! $bodyHtml !!}</div>
                    @if ($news->images->count())
                        <div class="news-gallery">
                            @foreach ($news->images as $image)
                                <img src="{{ $image->url }}" alt="{{ $news->title }}">
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="content-side">
                    @if ($news->sponsor_title || $news->sponsor_body || $news->sponsor_link)
                        <div class="ad-card">
                            <span class="ad-label">مساحة إعلان</span>
                            <h4>{{ $news->sponsor_title ?? 'راعي الخبر' }}</h4>
                            <p>{{ $news->sponsor_body ?? '' }}</p>
                            @if ($news->sponsor_link)
                                <a class="site-link" href="{{ $news->sponsor_link }}" target="_blank" rel="noopener">زيارة الراعي</a>
                            @endif
                        </div>
                    @endif
                    <div class="ad-card highlight">
                        <h4>هل ترغب في الدعم؟</h4>
                        <p>شارك في صناعة الأثر عبر التبرع أو التطوع.</p>
                        <a class="site-cta" href="{{ route('site.donations') }}">تبرع الآن</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
