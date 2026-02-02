@extends('site.layouts.app')

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1>{{ $service->title }}</h1>
            <p>{{ $service->summary ?? 'خدمة مجتمعية داعمة للأسر المستحقة.' }}</p>
        </div>
    </section>

    <section class="section-block">
        <div class="container">
            <div class="content-card content-card--split">
                <div class="content-main reveal-left">
                    <p>{{ $service->description ?? 'تفاصيل الخدمة سيتم إضافتها قريبًا.' }}</p>
                </div>
                <div class="content-side reveal-right">
                    <h4>كيف تساهم معنا؟</h4>
                    <p>يمكنك دعم هذه الخدمة بشكل مباشر أو تقديم تبرع عام.</p>
                    <a class="site-cta" href="{{ route('site.donations') }}">تبرع لهذه الخدمة</a>
                </div>
            </div>
        </div>
    </section>
@endsection
