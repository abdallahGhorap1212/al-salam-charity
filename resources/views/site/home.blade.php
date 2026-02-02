@extends('site.layouts.app', [
    'title' => 'جمعية السلام - مؤسسة خيرية تخدم المجتمع',
    'description' => 'جمعية السلام مؤسسة خيرية متخصصة في تقديم خدمات صحية واجتماعية وتعليمية للأسر المستحقة.'
])

@section('content')
    <section class="hero-section">
        <div class="container">
            <div class="hero-grid">
                <div class="hero-copy reveal-left">
                    <span class="hero-label" aria-label="اسم المؤسسة">🌟 جمعية السلام</span>
                    <h1 class="reveal-up delay-1">إيد واحدة تغيّر حياة كاملة</h1>
                    <p class="hero-description reveal-up delay-2">
                        {{ $about->summary ?? 'نصنع مبادرات تنموية مستدامة ونساند الأسر الأكثر احتياجًا عبر خدمات صحية واجتماعية وتعليمية.' }}
                    </p>
                    <p class="hero-legal reveal-up delay-3">
                        <span>جمعية السلام الإجتماعية بسلامون القماش</span>
                        <span>المشهرة برقم 854 بتاريخ 7/8/1999</span>
                    </p>
                    <div class="hero-actions reveal-up delay-4">
                        <a href="{{ route('site.donations') }}" class="site-cta site-cta--large" role="button" aria-label="ساهم في دعم مشاريعنا">
                            <i class="bi bi-hand-thumbs-up"></i> ساهم معنا
                        </a>
                        <a href="{{ route('site.services') }}" class="site-secondary" role="button" aria-label="تعرف على خدماتنا">
                            <i class="bi bi-arrow-right"></i> تعرّف على الخدمات
                        </a>
                    </div>
                    <div class="hero-stats reveal-up delay-4">
                        <div class="stat-item reveal-zoom delay-1">
                            <strong class="stat-number">{{ $services->count() }}</strong>
                            <span class="stat-label">خدمة نشطة</span>
                        </div>
                        <div class="stat-item reveal-zoom delay-2">
                            <strong class="stat-number">{{ $news->count() }}</strong>
                            <span class="stat-label">خبر حديث</span>
                        </div>
                        <div class="stat-item reveal-zoom delay-3">
                            <strong class="stat-number">{{ $boardMembers->count() }}</strong>
                            <span class="stat-label">عضو قيادة</span>
                        </div>
                    </div>
                </div>
                <div class="hero-card reveal-right">
                    <div class="hero-card-inner">
                        <img src="{{ asset('images/logo-transparent.png') }}" alt="شعار جمعية السلام" class="hero-logo float-slow">
                        <h3 class="reveal-up delay-1">{{ $about->title ?? 'جمعية السلام' }}</h3>
                        <p class="hero-subtitle reveal-up delay-2">{{ $about->subtitle ?? 'نخدم المجتمع بروح العطاء والكرامة' }}</p>
                        <div class="hero-highlight reveal-up delay-3">
                            <span class="highlight-label"><i class="bi bi-star-fill"></i> رسالتنا</span>
                            <strong class="highlight-text">{{ $about->mission ?? 'كرامة الإنسان أولاً، وخدمة المجتمع مسؤولية مشتركة.' }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-block">
        <div class="container">
            <div class="section-head">
                <h2><i class="bi bi-heart-handshake"></i> خدماتنا</h2>
                <p>مجالات عملنا الأساسية لخدمة أهلنا في المجتمع.</p>
                <a class="site-link site-link--view-all" href="{{ route('site.services') }}" title="عرض جميع الخدمات">
                    مشاهدة كل الخدمات <i class="bi bi-arrow-left"></i>
                </a>
            </div>
            @if($services->count() > 0)
                <div class="service-grid">
                    @foreach ($services->take(6) as $index => $service)
                        <article class="service-card reveal-up" style="--delay: {{ $index * 0.1 }}s;">
                            <div class="service-icon">
                                @if ($service->icon_url)
                                    <img src="{{ $service->icon_url }}" alt="{{ $service->title }}" loading="lazy">
                                @else
                                    <span class="service-placeholder">💼</span>
                                @endif
                            </div>
                            <h3>{{ $service->title }}</h3>
                            <p>{{ $service->summary ?? 'خدمة مجتمعية داعمة للأسر المستحقة.' }}</p>
                            <a href="{{ route('site.services.show', $service) }}" class="site-link" title="تفاصيل {{ $service->title }}">تفاصيل الخدمة</a>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <p>سيتم إضافة الخدمات قريبًا.</p>
                </div>
            @endif
        </div>
    </section>

    <section class="section-block section-accent">
        <div class="container">
            <div class="section-head">
                <h2><i class="bi bi-newspaper"></i> آخر الأخبار</h2>
                <p>تابع أهم المستجدات والمبادرات التي تنفذها الجمعية.</p>
                <a class="site-link site-link--view-all" href="{{ route('site.news') }}" title="عرض جميع الأخبار">
                    مزيد من الأخبار <i class="bi bi-arrow-left"></i>
                </a>
            </div>
            @if($news->count() > 0)
                <div class="news-grid">
                    @foreach ($news->take(3) as $index => $item)
                        <article class="news-card reveal-up" style="--delay: {{ $index * 0.1 }}s;">
                            <div class="news-card-media">
                                @if ($item->cover_image_url)
                                    <img src="{{ $item->cover_image_url }}" alt="{{ $item->title }}" loading="lazy" title="{{ $item->title }}">
                                @else
                                    <div class="news-placeholder">
                                        <i class="bi bi-newspaper"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="news-card-body">
                                <span class="news-date">
                                    <i class="bi bi-calendar-event"></i>
                                    {{ optional($item->published_at)?->format('d/m/Y') ?? $item->created_at->format('d/m/Y') }}
                                </span>
                                <h3>{{ $item->title }}</h3>
                                <p>{{ $item->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($item->body), 120) }}</p>
                                <a href="{{ route('site.news.show', $item) }}" class="site-link" title="اقرأ: {{ $item->title }}">اقرأ الخبر</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <p>لا توجد أخبار حالياً.</p>
                </div>
            @endif
        </div>
    </section>

    @if($boardMembers->count() > 0)
        <section class="section-block">
            <div class="container">
                <div class="section-head">
                    <h2><i class="bi bi-people"></i> مجلس الإدارة</h2>
                    <p>قيادات تعمل بخبرة وشغف لخدمة المجتمع.</p>
                </div>
                <div class="board-marquee" data-marquee>
                    <div class="board-marquee-inner" data-marquee-inner>
                        <div class="board-track" data-marquee-track>
                        @foreach ($boardMembers as $member)
                            <article class="board-card">
                                <div class="board-avatar">
                                    @if ($member->photo_url)
                                        <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" loading="lazy">
                                    @else
                                        <span class="initials">{{ mb_substr($member->name, 0, 1) }}</span>
                                    @endif
                                </div>
                                <h3>{{ $member->name }}</h3>
                                <p class="role">{{ $member->role ?? 'عضو مجلس الإدارة' }}</p>
                                @if ($member->bio)
                                    <small class="bio">{{ $member->bio }}</small>
                                @endif
                            </article>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="cta-section">
        <div class="container">
            <div class="cta-card">
                <div>
                    <h2><i class="bi bi-heart-fill"></i> ابدأ رحلة العطاء معنا</h2>
                    <p>تبرعك يصنع أثرًا مباشرًا ويغير حياة المستحقين نحو الأفضل.</p>
                </div>
                <a class="site-cta site-cta--large" href="{{ route('site.donations') }}" role="button" aria-label="اذهب لصفحة التبرعات">
                    <i class="bi bi-hand-thumbs-up"></i> اذهب للتبرع
                </a>
            </div>
        </div>
    </section>
@endsection
