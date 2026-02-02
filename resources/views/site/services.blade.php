@extends('site.layouts.app', [
    'title' => 'خدماتنا - جمعية السلام',
    'description' => 'تعرف على خدماتنا الاجتماعية والصحية والتعليمية التي نقدمها للمجتمع.'
])

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1><i class="bi bi-heart-handshake"></i> خدماتنا</h1>
            <p>مجالات العمل التي نقدمها لخدمة المجتمع والأسر المحتاجة.</p>
        </div>
    </section>

    <section class="section-block">
        <div class="container">
            @if($services->count() > 0)
                <div class="service-grid service-grid--page">
                    @forelse ($services as $index => $service)
                        <article class="service-card service-card--cover reveal-up" style="--delay: {{ $index * 0.1 }}s;">
                            <div class="service-cover">
                                @if ($service->icon_url)
                                    <img src="{{ $service->icon_url }}" alt="{{ $service->title }}" loading="lazy">
                                @else
                                    <span class="placeholder-icon">💼</span>
                                @endif
                            </div>
                            <div class="service-body">
                                <h3>{{ $service->title }}</h3>
                                <p class="service-summary">{{ $service->summary ?? 'خدمة مجتمعية داعمة للأسر المحتاجة.' }}</p>
                                <a href="{{ route('site.services.show', $service) }}" class="site-link" title="تفاصيل {{ $service->title }}">
                                    <span>تفاصيل الخدمة</span>
                                    <i class="bi bi-arrow-left"></i>
                                </a>
                            </div>
                        </article>
                    @empty
                        <div class="empty-state">
                            <i class="bi bi-inbox"></i>
                            <p>سيتم إضافة الخدمات قريبًا.</p>
                        </div>
                    @endforelse
                </div>

                @if($services->hasPages())
                    <div class="pagination-wrapper mt-5">
                        {{ $services->withQueryString()->links('pagination.site') }}
                    </div>
                @endif
            @else
                <div class="empty-state empty-state--large">
                    <i class="bi bi-inbox"></i>
                    <h3>لا توجد خدمات متاحة حاليًا</h3>
                    <p>يتم العمل على إضافة خدماتنا. يرجى التحقق لاحقًا أو <a href="{{ route('site.contact') }}">تواصل معنا</a>.</p>
                </div>
            @endif
        </div>
    </section>

    <section class="section-block section-accent">
        <div class="container">
            <div class="section-head">
                <h2>لماذا نختار خدماتنا؟</h2>
                <p>نقدم خدمات موثوقة وفعّالة بأعلى معايير الجودة والشفافية.</p>
            </div>
            <div class="features-grid">
                <div class="feature-card reveal-up">
                    <div class="feature-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h4>معايير عالية</h4>
                    <p>جميع خدماتنا تتوافق مع أفضل المعايير العالمية والمحلية.</p>
                </div>
                <div class="feature-card reveal-up delay-1">
                    <div class="feature-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <h4>فريق متخصص</h4>
                    <p>فريق من المتخصصين والمتطوعين المدربين على أعلى مستوى.</p>
                </div>
                <div class="feature-card reveal-up delay-2">
                    <div class="feature-icon">
                        <i class="bi bi-bar-chart"></i>
                    </div>
                    <h4>نتائج ملموسة</h4>
                    <p>نركز على تحقيق نتائج إيجابية وملموسة في حياة المستفيدين.</p>
                </div>
                <div class="feature-card reveal-up delay-3">
                    <div class="feature-icon">
                        <i class="bi bi-eye"></i>
                    </div>
                    <h4>شفافية كاملة</h4>
                    <p>نعمل بشفافية كاملة ونشارك تقارير منتظمة عن أدائنا.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <div class="cta-card">
                <div>
                    <h2>هل تحتاج إلى إحدى خدماتنا؟</h2>
                    <p>تواصل معنا الآن واطلب الخدمة التي تحتاجها. فريقنا جاهز لمساعدتك.</p>
                </div>
                <a class="site-cta" href="{{ route('site.contact') }}" role="button" aria-label="تواصل معنا">
                    <i class="bi bi-telephone"></i> تواصل معنا
                </a>
            </div>
        </div>
    </section>
@endsection
