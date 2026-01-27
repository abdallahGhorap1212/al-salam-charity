@extends('site.layouts.app')

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1>نبذة عن الجمعية</h1>
            <p>{{ $about->summary ?? 'جمعية السلام مؤسسة خيرية تهدف إلى تمكين الأسر ومساندة المجتمع بخدمات متنوعة.' }}</p>
        </div>
    </section>

    <section class="section-block">
        <div class="container">
            <div class="about-grid">
                <div>
                    <h2>{{ $about->title ?? 'جمعية السلام' }}</h2>
                    <p>{{ $about->body ?? 'نعمل على إطلاق مبادرات تنموية مستدامة، ونقدّم الدعم للأسر الأكثر احتياجًا.' }}</p>
                </div>
                <div class="about-cards">
                    <div class="about-card">
                        <span>رسالتنا</span>
                        <strong>{{ $about->mission ?? 'خدمة المجتمع وتعزيز قيم التكافل.' }}</strong>
                    </div>
                    <div class="about-card">
                        <span>رؤيتنا</span>
                        <strong>{{ $about->vision ?? 'مجتمع متكافل يحيا بكرامة.' }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-block section-accent">
        <div class="container">
            <div class="section-head">
                <h2>مجلس الإدارة</h2>
                <p>قيادات الجمعية وخبراتها.</p>
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
@endsection
