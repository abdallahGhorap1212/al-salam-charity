@extends('site.layouts.app')

@section('title', 'الشروط والأحكام')

@section('content')
    <section class="page-hero page-hero--center">
        <div class="container">
            <div class="page-hero__content">
                <h1>الشروط والأحكام</h1>
                <p>يرجى قراءة الشروط والأحكام بعناية قبل استخدام خدماتنا</p>
            </div>
        </div>
    </section>

    <section class="section-block">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="terms-card">
                        @if($termsAndConditions && $termsAndConditions->is_active)
                            <div class="terms-header">
                                <h2>{{ $termsAndConditions->title }}</h2>
                                <p class="text-muted">
                                    آخر تحديث: {{ $termsAndConditions->updated_at->translatedFormat('d F Y') }}
                                </p>
                            </div>

                            @if($termsAndConditions->summary)
                                <div class="alert alert-info mb-4">
                                    <h5 class="alert-heading">ملخص الشروط</h5>
                                    <p class="mb-0">{{ $termsAndConditions->summary }}</p>
                                </div>
                            @endif

                            <div class="terms-content">
                                {!! nl2br(e($termsAndConditions->content)) !!}
                            </div>

                            <div class="terms-footer">
                                <h5>هل لديك أسئلة؟</h5>
                                <p>إذا كانت لديك أي استفسارات حول هذه الشروط والأحكام، يرجى <a href="{{ route('site.contact') }}">التواصل معنا</a>.</p>
                            </div>
                        @else
                            <div class="alert alert-warning">
                                <p>الشروط والأحكام غير متاحة حالياً. يرجى المحاولة لاحقاً.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
