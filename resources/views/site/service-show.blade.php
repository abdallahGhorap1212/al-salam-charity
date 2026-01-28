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
            <div class="content-card" style="display: grid; grid-template-columns: 1fr 350px; gap: 3rem; align-items: start;">
                <div class="content-main" style="animation: slideInLeft 0.6s ease-out;">
                    <p>{{ $service->description ?? 'تفاصيل الخدمة سيتم إضافتها قريبًا.' }}</p>
                </div>
                <div class="content-side" style="animation: slideInRight 0.6s ease-out;">
                    <h4>كيف تساهم معنا؟</h4>
                    <p>يمكنك دعم هذه الخدمة بشكل مباشر أو تقديم تبرع عام.</p>
                    <a class="site-cta" href="{{ route('site.donations') }}">تبرع لهذه الخدمة</a>
                </div>
            </div>
        </div>
    </section>
@endsection
