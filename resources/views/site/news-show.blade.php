@extends('site.layouts.app')

@section('content')
    <section class="page-hero page-hero--image" style="--hero-image: url('{{ $news->cover_image_url ?? asset('images/placeholder.jpg') }}');">
        <div class="container page-hero__inner">
            <div class="page-hero__content reveal-up">
                <h1>{{ $news->title }}</h1>
                <div class="page-hero__meta">
                    <div class="meta-item">
                        <i class="bi bi-calendar-event"></i>
                        <time datetime="{{ optional($news->published_at)?->toIso8601String() ?? $news->created_at->toIso8601String() }}">
                            {{ optional($news->published_at)?->translatedFormat('d F Y') ?? $news->created_at->translatedFormat('d F Y') }}
                        </time>
                    </div>
                    <div class="meta-item">
                        <i class="bi bi-clock-history"></i>
                        <span>{{ ceil(strlen(strip_tags($news->body)) / 200) }} دقائق قراءة</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-block">
        <div class="container">
            <div class="content-card content-card--split">
                <div class="content-main reveal-left">
                    @if ($news->cover_image_url)
                        <img src="{{ $news->cover_image_url }}" alt="{{ $news->title }}" class="content-image">
                    @endif
                    @if ($news->excerpt)
                        <p class="lead">{{ $news->excerpt }}</p>
                    @endif
                    <div class="news-body">{!! $bodyHtml !!}</div>
                    @if ($news->images->count())
                        <div class="news-gallery">
                            @foreach ($news->images as $index => $image)
                                <img src="{{ $image->url }}" alt="{{ $news->title }}" class="reveal-zoom" style="--delay: {{ $index * 0.1 }}s;">
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="content-side reveal-right">
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
