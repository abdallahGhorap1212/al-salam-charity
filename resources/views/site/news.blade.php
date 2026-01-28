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
                <div class="news-grid news-grid--page" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                    @forelse ($news as $index => $item)
                        <article class="news-card news-card--featured" style="animation: fadeInUp 0.6s ease-out {{ $index * 0.1 }}s backwards;">
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
                                    <span class="news-badge" style="background: linear-gradient(135deg, rgba(23, 121, 186, 0.95), rgba(41, 128, 185, 0.95)); backdrop-filter: blur(10px); color: white; padding: 0.5rem 1rem; border-radius: 20px; font-size: 0.85rem; font-weight: 600; display: flex; align-items: center; gap: 0.5rem; position: absolute; top: 1rem; right: 1rem; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);">
                                        <i class="bi bi-calendar2-check" style="font-size: 0.9rem;"></i>
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
                <div class="social-links-cta" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 1.5rem;">
                    <a href="https://facebook.com" target="_blank" rel="noopener" aria-label="فيسبوك" title="تابعنا على فيسبوك" style="animation: slideInUp 0.6s ease-out 0.3s backwards; display: inline-flex; align-items: center; justify-content: center; gap: 0.75rem; padding: 0.875rem 1.25rem; border-radius: 8px; background: linear-gradient(135deg, #1877F2, #0A66C2); color: white; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(24, 119, 242, 0.2); font-weight: 500;">
                        <i class="bi bi-facebook" style="font-size: 1.25rem;"></i> فيسبوك
                    </a>
                    <a href="https://twitter.com" target="_blank" rel="noopener" aria-label="تويتر" title="تابعنا على تويتر" style="animation: slideInUp 0.6s ease-out 0.4s backwards; display: inline-flex; align-items: center; justify-content: center; gap: 0.75rem; padding: 0.875rem 1.25rem; border-radius: 8px; background: linear-gradient(135deg, #1DA1F2, #1a8917); color: white; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(29, 161, 242, 0.2); font-weight: 500;">
                        <i class="bi bi-twitter" style="font-size: 1.25rem;"></i> تويتر
                    </a>
                    <a href="https://instagram.com" target="_blank" rel="noopener" aria-label="إنستجرام" title="تابعنا على إنستجرام" style="animation: slideInUp 0.6s ease-out 0.5s backwards; display: inline-flex; align-items: center; justify-content: center; gap: 0.75rem; padding: 0.875rem 1.25rem; border-radius: 8px; background: linear-gradient(135deg, #F58529, #DD2A7B, #8134AF); color: white; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(245, 133, 41, 0.2); font-weight: 500;">
                        <i class="bi bi-instagram" style="font-size: 1.25rem;"></i> إنستجرام
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
