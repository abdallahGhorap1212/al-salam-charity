@extends('site.layouts.app')

@section('content')
    <section class="page-hero" style="background: linear-gradient(135deg, rgba(23, 121, 186, 0.9), rgba(41, 128, 185, 0.9)), url('{{ $news->cover_image_url ?? asset('images/placeholder.jpg') }}') center/cover; color: white;">
        <div class="container" style="display: grid; grid-template-columns: 1fr; gap: 2rem; padding: 4rem 0;">
            <div style="max-width: 800px;">
                <h1 style="font-size: 2.5rem; margin-bottom: 1.5rem; animation: slideInUp 0.6s ease-out;">{{ $news->title }}</h1>
                <div style="display: grid; grid-template-columns: auto auto; gap: 2rem; align-items: center; animation: slideInUp 0.6s ease-out 0.2s backwards;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <i class="bi bi-calendar-event" style="font-size: 1.25rem;"></i>
                        <time datetime="{{ optional($news->published_at)?->toIso8601String() ?? $news->created_at->toIso8601String() }}" style="font-size: 1.1rem; font-weight: 500;">
                            {{ optional($news->published_at)?->translatedFormat('d F Y') ?? $news->created_at->translatedFormat('d F Y') }}
                        </time>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <i class="bi bi-clock-history" style="font-size: 1.25rem;"></i>
                        <span style="font-size: 1rem; opacity: 0.9;">{{ ceil(strlen(strip_tags($news->body)) / 200) }} دقائق قراءة</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-block">
        <div class="container">
            <div class="content-card" style="display: grid; grid-template-columns: 1fr 350px; gap: 3rem; align-items: start;">
                <div class="content-main" style="animation: slideInLeft 0.6s ease-out;">
                    @if ($news->cover_image_url)
                        <img src="{{ $news->cover_image_url }}" alt="{{ $news->title }}" class="content-image">
                    @endif
                    @if ($news->excerpt)
                        <p class="lead">{{ $news->excerpt }}</p>
                    @endif
                    <div class="news-body">{!! $bodyHtml !!}</div>
                    @if ($news->images->count())
                        <div class="news-gallery" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-top: 2rem;">
                            @foreach ($news->images as $index => $image)
                                <img src="{{ $image->url }}" alt="{{ $news->title }}" style="border-radius: 8px; object-fit: cover; animation: zoomIn 0.6s ease-out {{ $index * 0.1 }}s backwards;">
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="content-side" style="animation: slideInRight 0.6s ease-out;">
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
