@extends('site.layouts.app')

@section('title', 'الشروط والأحكام')

@section('content')
    <!-- Hero Section -->
    <section class="site-page-hero">
        <div class="container">
            <div class="hero-content">
                <h1>الشروط والأحكام</h1>
                <p>يرجى قراءة الشروط والأحكام بعناية قبل استخدام خدماتنا</p>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="terms-card">
                        @if($termsAndConditions && $termsAndConditions->is_active)
                            <div class="terms-header mb-4">
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

                            <div class="terms-footer mt-5 pt-4 border-top">
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

@push('styles')
    <style>
        .site-page-hero {
            background: linear-gradient(135deg, var(--brand-900), var(--brand-700));
            color: white;
            padding: 60px 0;
            margin-bottom: 40px;
            text-align: center;
        }

        .site-page-hero h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .site-page-hero p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .terms-card {
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .terms-header h2 {
            color: var(--brand-900);
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .terms-content {
            font-size: 1rem;
            line-height: 1.8;
            color: #333;
        }

        .terms-content p {
            margin-bottom: 1.5rem;
        }

        .alert-info {
            background: rgba(0, 188, 212, 0.1);
            border-color: rgba(0, 188, 212, 0.3);
        }

        .terms-footer {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 8px;
            margin-top: 2rem;
        }

        .terms-footer h5 {
            color: var(--brand-900);
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .site-page-hero h1 {
                font-size: 1.8rem;
            }

            .terms-card {
                padding: 20px;
            }
        }
    </style>
@endpush
