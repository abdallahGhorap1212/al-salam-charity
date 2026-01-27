@extends('site.layouts.app')

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1>الأخبار</h1>
            <p>تابع آخر أخبار ومبادرات جمعية السلام.</p>
        </div>
    </section>

    <section class="section-block">
        <div class="container">
            <div class="news-grid news-grid--page">
                @forelse ($news as $item)
                    <article class="news-card">
                        <div class="news-card-media">
                            @if ($item->cover_image_url)
                                <img src="{{ $item->cover_image_url }}" alt="{{ $item->title }}">
                            @endif
                        </div>
                        <div class="news-card-body">
                            <span class="news-date">{{ optional($item->published_at)->format('Y-m-d') ?? $item->created_at->format('Y-m-d') }}</span>
                            <h3>{{ $item->title }}</h3>
                            <p>{{ $item->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($item->body), 140) }}</p>
                            <a href="{{ route('site.news.show', $item) }}" class="site-link">اقرأ الخبر</a>
                        </div>
                    </article>
                @empty
                    <div class="empty-state">لا توجد أخبار حالياً.</div>
                @endforelse
            </div>

            <div class="news-pagination mt-5">
                {{ $news->withQueryString()->links('pagination.site') }}
            </div>
        </div>
    </section>
@endsection
