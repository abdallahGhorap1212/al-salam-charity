@extends('site.layouts.app', [
    'title' => 'الأخبار - جمعية السلام',
    'description' => 'تابع آخر أخبار ومبادرات جمعية السلام والمشاريع الجديدة.'
])

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1><i class="bi bi-newspaper"></i> الأخبار والمستجدات</h1>
            <p>تابع آخر أخبار ومبادرات جمعية السلام والمشاريع الجديدة التي نقوم بها.</p>
        </div>
    </section>

    <section class="section-block">
        <div class="container">
            @if($news->count() > 0)
                <div class="news-grid news-grid--page">
                    @forelse ($news as $index => $item)
                        <article class="news-card news-card--featured reveal-up" style="--delay: {{ $index * 0.1 }}s;">
                            <div class="news-card-media">
                                @if ($item->cover_image_url)
                                    <img 
                                        src="{{ $item->cover_image_url }}" 
                                        alt="{{ $item->title }}"
                                        loading="lazy"
                                        title="{{ $item->title }}">
                                @else
                                    <div class="news-placeholder">
                                        <i class="bi bi-newspaper"></i>
                                    </div>
                                @endif
                                @if($item->published_at)
                                    <span class="news-badge">
                                        <i class="bi bi-calendar2-check"></i>
                                        {{ $item->published_at->translatedFormat('d M Y') }}
                                    </span>
                                @endif
                            </div>
                            <div class="news-card-body">
                                <div class="news-meta">
                                    <time datetime="{{ optional($item->published_at)?->toIso8601String() ?? $item->created_at->toIso8601String() }}">
                                        <i class="bi bi-calendar-event"></i>
                                        {{ optional($item->published_at)?->format('d / m / Y') ?? $item->created_at->format('d / m / Y') }}
                                    </time>
                                </div>
                                <h3>{{ $item->title }}</h3>
                                <p class="news-excerpt">
                                    {{ $item->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($item->body), 150) }}
                                </p>
                                <a 
                                    href="{{ route('site.news.show', $item) }}" 
                                    class="site-link" 
                                    title="اقرأ خبر: {{ $item->title }}"
                                    aria-label="اقرأ المزيد عن {{ $item->title }}">
                                    <span>اقرأ الخبر الكامل</span>
                                    <i class="bi bi-arrow-left"></i>
                                </a>
                            </div>
                        </article>
                    @empty
                        <div class="empty-state empty-state--large">
                            <i class="bi bi-inbox"></i>
                            <h3>لا توجد أخبار حاليًا</h3>
                            <p>سيتم مشاركة الأخبار والمستجدات قريبًا. <a href="{{ route('site.home') }}">العودة للرئيسية</a></p>
                        </div>
                    @endforelse
                </div>

                @if($news->hasPages())
                    <div class="pagination-wrapper mt-5">
                        {{ $news->withQueryString()->links('pagination.site') }}
                    </div>
                @endif
            @else
                <div class="empty-state empty-state--large">
                    <i class="bi bi-inbox"></i>
                    <h3>لا توجد أخبار حاليًا</h3>
                    <p>قريبًا سنشارك معكم آخر المستجدات والإنجازات. <a href="{{ route('site.home') }}">العودة للرئيسية</a></p>
                </div>
            @endif
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <div class="cta-card">
                <div>
                    <h2>ابق على اطلاع دائم</h2>
                    <p>تابعنا على وسائل التواصل الاجتماعي للحصول على آخر الأخبار والمستجدات.</p>
                </div>
                <div class="social-links-cta">
                    <a href="https://facebook.com" target="_blank" rel="noopener" aria-label="فيسبوك" title="تابعنا على فيسبوك" class="social-pill social-pill--facebook reveal-up delay-2">
                        <i class="bi bi-facebook"></i> فيسبوك
                    </a>
                    <a href="https://twitter.com" target="_blank" rel="noopener" aria-label="تويتر" title="تابعنا على تويتر" class="social-pill social-pill--twitter reveal-up delay-3">
                        <i class="bi bi-twitter"></i> تويتر
                    </a>
                    <a href="https://instagram.com" target="_blank" rel="noopener" aria-label="إنستجرام" title="تابعنا على إنستجرام" class="social-pill social-pill--instagram reveal-up delay-4">
                        <i class="bi bi-instagram"></i> إنستجرام
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
