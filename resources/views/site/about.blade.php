@extends('site.layouts.app', [
    'title' => $about->title ? $about->title . ' - جمعية السلام' : 'عن الجمعية - جمعية السلام',
    'description' => $about->summary ?? 'تعرف على جمعية السلام ورسالتها وأهدافها في خدمة المجتمع.'
])

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1>{{ $about->title ?? 'عن الجمعية' }}</h1>
            <p>{{ $about->summary ?? 'جمعية السلام مؤسسة خيرية تهدف إلى تمكين الأسر ومساندة المجتمع بخدمات متنوعة.' }}</p>
        </div>
    </section>

    <section class="section-block">
        <div class="container">
            <div class="mission-vision-grid">
                <div class="mission-card reveal-up">
                    <div class="card-icon mission-icon">
                        <i class="bi bi-bullseye"></i>
                    </div>
                    <h3>رسالتنا</h3>
                    <p>{{ $about->mission ?? 'خدمة المجتمع وتعزيز قيم التكافل الاجتماعي.' }}</p>
                </div>
                <div class="vision-card reveal-up delay-1">
                    <div class="card-icon vision-icon">
                        <i class="bi bi-eye"></i>
                    </div>
                    <h3>رؤيتنا</h3>
                    <p>{{ $about->vision ?? 'مجتمع متكافل يحيا بكرامة وسلام.' }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-block section-light">
        <div class="container">
            <div class="about-grid">
                <div class="about-content">
                    <h2>{{ $about->title ?? 'جمعية السلام' }}</h2>
                    <p class="lead">{{ $about->body ?? 'نعمل على إطلاق مبادرات تنموية مستدامة، ونقدّم الدعم للأسر الأكثر احتياجًا.' }}</p>
                    <p class="org-legal">
                        <span>جمعية السلام الإجتماعية بسلامون القماش</span>
                        <span>المشهرة برقم 854 بتاريخ 7/8/1999</span>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-block">
        <div class="container">
            <div class="section-head">
                <h2><i class="bi bi-award"></i> قيمنا الأساسية</h2>
                <p>المبادئ التي توجه كل عملنا وتحركنا نحو الهدف.</p>
            </div>
            <div class="values-grid">
                <div class="value-card reveal-up">
                    <div class="value-icon social-justice">
                        <i class="bi bi-people"></i>
                    </div>
                    <h4>العدالة الاجتماعية</h4>
                    <p>معاملة جميع الأسر بمساواة واحترام دون تمييز</p>
                </div>
                <div class="value-card reveal-up delay-1">
                    <div class="value-icon sustainability">
                        <i class="bi bi-tree"></i>
                    </div>
                    <h4>الاستدامة</h4>
                    <p>برامج طويلة الأجل تحدث تأثيرًا حقيقيًا ودائمًا</p>
                </div>
                <div class="value-card reveal-up delay-2">
                    <div class="value-icon transparency">
                        <i class="bi bi-eye"></i>
                    </div>
                    <h4>الشفافية</h4>
                    <p>الوضوح التام في أداء المشاريع والميزانيات</p>
                </div>
                <div class="value-card reveal-up delay-3">
                    <div class="value-icon efficiency">
                        <i class="bi bi-speedometer"></i>
                    </div>
                    <h4>الكفاءة</h4>
                    <p>استخدام أمثل للموارد والإمكانيات المتاحة</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-block section-accent">
        <div class="container">
            <div class="section-head">
                <h2><i class="bi bi-bar-chart"></i> إحصائيات الأداء</h2>
                <p>أرقام تعكس تأثيرنا المستمر في المجتمع.</p>
            </div>
            <div class="stats-grid">
                <div class="stat-box reveal-zoom">
                    <div class="stat-icon families">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $totalCases ?? 0 }}</h3>
                        <p>عائلة استفادت</p>
                        <small>من خدماتنا وبرامجنا</small>
                    </div>
                </div>
                <div class="stat-box reveal-zoom delay-1">
                    <div class="stat-icon projects">
                        <i class="bi bi-boxes"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $totalDistributions ?? 0 }}</h3>
                        <p>مشروع منفذ</p>
                        <small>بنجاح وفعالية</small>
                    </div>
                </div>
                <div class="stat-box reveal-zoom delay-2">
                    <div class="stat-icon team">
                        <i class="bi bi-person-heart"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $totalMembers ?? 0 }}</h3>
                        <p>متطوع وموظف</p>
                        <small>يعملون بشغف وإخلاص</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-block">
        <div class="container">
            <div class="section-head">
                <h2><i class="bi bi-people"></i> مجلس الإدارة</h2>
                <p>القيادات التي تقود مسيرة الجمعية برؤية استراتيجية وخبرة عملية.</p>
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
                                    <span class="initials">{{ mb_substr($member->name, 0, 1) }}</span>
                                @endif
                            </div>
                            <h3>{{ $member->name }}</h3>
                            <p class="role">{{ $member->role ?? 'عضو مجلس الإدارة' }}</p>
                            @if ($member->bio)
                                <small class="bio">{{ $member->bio }}</small>
                            @endif
                        </article>
                    @empty
                        <div class="empty-state">
                            <i class="bi bi-inbox"></i>
                            <p>سيتم إضافة أعضاء المجلس قريبًا.</p>
                        </div>
                    @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
