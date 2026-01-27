@extends('site.layouts.app')

@section('content')
    <section class="hero-section">
        <div class="container">
            <div class="hero-grid">
                <div class="hero-copy">
                    <span class="hero-label">جمعية السلام</span>
                    <h1>إيد واحدة تغيّر حياة كاملة</h1>
                    <p>
                        {{ $about->summary ?? 'نصنع مبادرات تنموية مستدامة ونساند الأسر الأكثر احتياجًا عبر خدمات صحية واجتماعية وتعليمية.' }}
                    </p>
                    <div class="hero-actions">
                        <a href="{{ route('site.donations') }}" class="site-cta">ساهم معنا</a>
                        <a href="{{ route('site.services') }}" class="site-secondary">تعرّف على الخدمات</a>
                    </div>
                    <div class="hero-stats">
                        <div>
                            <strong>{{ $services->count() }}</strong>
                            <span>خدمة نشطة</span>
                        </div>
                        <div>
                            <strong>{{ $news->count() }}</strong>
                            <span>خبر حديث</span>
                        </div>
                        <div>
                            <strong>{{ $boardMembers->count() }}</strong>
                            <span>عضو مجلس إدارة</span>
                        </div>
                    </div>
                </div>
                <div class="hero-card">
                    <div class="hero-card-inner">
                        <img src="{{ asset('images/logo-transparent.png') }}" alt="جمعية السلام">
                        <h3>{{ $about->title ?? 'جمعية السلام' }}</h3>
                        <p>{{ $about->subtitle ?? 'نخدم المجتمع بروح العطاء' }}</p>
                        <div class="hero-highlight">
                            <span>رسالتنا</span>
                            <strong>{{ $about->mission ?? 'كرامة الإنسان أولاً، وخدمة المجتمع مسؤولية مشتركة.' }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-block">
        <div class="container">
            <div class="section-head">
                <h2>خدماتنا</h2>
                <p>مجالات عملنا الأساسية لخدمة أهلنا في المجتمع.</p>
                <a class="site-link" href="{{ route('site.services') }}">مشاهدة كل الخدمات</a>
            </div>
            <div class="service-grid">
                @forelse ($services as $service)
                    <article class="service-card">
                        <div class="service-icon">
                            @if ($service->icon_url)
                                <img src="{{ $service->icon_url }}" alt="{{ $service->title }}">
                            @else
                                <span>⭐</span>
                            @endif
                        </div>
                        <h3>{{ $service->title }}</h3>
                        <p>{{ $service->summary ?? 'خدمة مجتمعية داعمة للأسر المستحقة.' }}</p>
                        <a href="{{ route('site.services.show', $service) }}" class="site-link">تفاصيل الخدمة</a>
                    </article>
                @empty
                    <div class="empty-state">سيتم إضافة الخدمات قريبًا.</div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="section-block section-accent">
        <div class="container">
            <div class="section-head">
                <h2>آخر الأخبار</h2>
                <p>تابع أهم المستجدات والمبادرات التي تنفذها الجمعية.</p>
                <a class="site-link" href="{{ route('site.news') }}">مزيد من الأخبار</a>
            </div>
            <div class="news-grid">
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
                            <p>{{ $item->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($item->body), 120) }}</p>
                            <a href="{{ route('site.news.show', $item) }}" class="site-link">اقرأ الخبر</a>
                        </div>
                    </article>
                @empty
                    <div class="empty-state">لا توجد أخبار حالياً.</div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="section-block">
        <div class="container">
            <div class="section-head">
                <h2>مجلس الإدارة</h2>
                <p>قيادات تعمل بخبرة وشغف لخدمة المجتمع.</p>
            </div>
            <div class="board-marquee" data-marquee>
                <div class="board-marquee-inner" data-marquee-inner>
                    <div class="board-track" data-marquee-track>
                    @forelse ($boardMembers as $member)
                        <article class="board-card">
                            <div class="board-avatar">
                                @if ($member->photo_url)
                                    <img src="{{ $member->photo_url }}" alt="{{ $member->name }}">
                                @else
                                    <span>{{ mb_substr($member->name, 0, 1) }}</span>
                                @endif
                            </div>
                            <h3>{{ $member->name }}</h3>
                            <p>{{ $member->role ?? 'عضو مجلس الإدارة' }}</p>
                            @if ($member->bio)
                                <small>{{ $member->bio }}</small>
                        @endif
                    </article>
                @empty
                    <div class="empty-state">سيتم إضافة أعضاء المجلس قريبًا.</div>
                @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <div class="cta-card">
                <div>
                    <h2>ابدأ رحلة العطاء معنا</h2>
                    <p>تبرعك يصنع أثرًا مباشرًا ويغير حياة المستحقين.</p>
                </div>
                <a class="site-cta" href="{{ route('site.donations') }}">اذهب للتبرع</a>
            </div>
        </div>
    </section>
@endsection
