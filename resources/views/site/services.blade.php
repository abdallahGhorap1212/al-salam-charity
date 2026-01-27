@extends('site.layouts.app')

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1>خدماتنا</h1>
            <p>مجالات العمل التي نقدمها لخدمة المجتمع.</p>
        </div>
    </section>

    <section class="section-block">
        <div class="container">
            <div class="service-grid service-grid--page">
                @forelse ($services as $service)
                    <article class="service-card service-card--cover">
                        <div class="service-cover">
                            @if ($service->icon_url)
                                <img src="{{ $service->icon_url }}" alt="{{ $service->title }}">
                            @else
                                <span>⭐</span>
                            @endif
                        </div>
                        <div class="service-body">
                            <h3>{{ $service->title }}</h3>
                            <p>{{ $service->summary ?? 'خدمة مجتمعية داعمة للأسر المستحقة.' }}</p>
                            <a href="{{ route('site.services.show', $service) }}" class="site-link">تفاصيل الخدمة</a>
                        </div>
                    </article>
                @empty
                    <div class="empty-state">سيتم إضافة الخدمات قريبًا.</div>
                @endforelse
            </div>

            <div class="news-pagination mt-5">
                {{ $services->withQueryString()->links('pagination.site') }}
            </div>
        </div>
    </section>
@endsection
