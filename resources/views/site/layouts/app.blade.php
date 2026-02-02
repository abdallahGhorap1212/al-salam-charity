<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- SEO Tags -->
    <title>{{ $title ?? 'جمعية السلام - مؤسسة خيرية تخدم المجتمع' }}</title>
    <meta name="description" content="{{ $description ?? 'جمعية السلام مؤسسة خيرية متخصصة في تقديم خدمات صحية واجتماعية وتعليمية للأسر المستحقة. معًا نصنع أثرًا حقيقيًا في المجتمع.' }}">
    <meta name="keywords" content="جمعية خيرية, التكافل الاجتماعي, خدمات اجتماعية, تبرعات, أسر محتاجة">
    <meta name="author" content="جمعية السلام">
    
    <!-- Open Graph Tags -->
    <meta property="og:title" content="{{ $title ?? 'جمعية السلام - مؤسسة خيرية' }}">
    <meta property="og:description" content="{{ $description ?? 'خدمات صحية واجتماعية وتعليمية للمجتمع' }}">
    <meta property="og:image" content="{{ asset('images/logo-transparent.png') }}">
    <meta property="og:type" content="{{ $ogType ?? 'website' }}">
    <meta property="og:locale" content="ar_AR">
    
    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? 'جمعية السلام' }}">
    <meta name="twitter:description" content="{{ $description ?? 'مؤسسة خيرية تخدم المجتمع' }}">
    <meta name="twitter:image" content="{{ asset('images/logo-transparent.png') }}">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Changa:400,600,700,800|Cairo:300,400,600,700" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" href="{{ asset('images/logo-transparent.png') }}">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Animations Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="site-shell">
    <header class="site-header" role="banner">
        <div class="container">
            <div class="site-header-inner">
                <a class="site-brand" href="{{ route('site.home') }}" aria-label="جمعية السلام - الرئيسية">
                    <img src="{{ asset('images/logo-transparent.png') }}" alt="شعار جمعية السلام">
                    <span>
                        <strong>جمعية السلام</strong>
                        <small>مؤسسة خيرية | معًا لنصنع أثرًا حقيقيًا</small>
                    </span>
                </a>
                <button class="site-nav-toggle" type="button" aria-label="فتح القائمة" aria-expanded="false" aria-controls="siteNav">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <nav id="siteNav" class="site-nav" role="navigation" aria-label="القائمة الرئيسية">
                    <a href="{{ route('site.home') }}" class="nav-link {{ request()->routeIs('site.home') ? 'active' : '' }}" aria-current="{{ request()->routeIs('site.home') ? 'page' : 'false' }}">
                        <i class="bi bi-house"></i> الرئيسية
                    </a>
                    <a href="{{ route('site.about') }}" class="nav-link {{ request()->routeIs('site.about') ? 'active' : '' }}" aria-current="{{ request()->routeIs('site.about') ? 'page' : 'false' }}">
                        <i class="bi bi-info-circle"></i> عن الجمعية
                    </a>
                    <a href="{{ route('site.services') }}" class="nav-link {{ request()->routeIs('site.services*') ? 'active' : '' }}" aria-current="{{ request()->routeIs('site.services*') ? 'page' : 'false' }}">
                        <i class="bi bi-heart-handshake"></i> الخدمات
                    </a>
                    <a href="{{ route('site.news') }}" class="nav-link {{ request()->routeIs('site.news*') ? 'active' : '' }}" aria-current="{{ request()->routeIs('site.news*') ? 'page' : 'false' }}">
                        <i class="bi bi-newspaper"></i> الأخبار
                    </a>
                    <a href="{{ route('site.contact') }}" class="nav-link {{ request()->routeIs('site.contact') ? 'active' : '' }}" aria-current="{{ request()->routeIs('site.contact') ? 'page' : 'false' }}">
                        <i class="bi bi-chat-dots"></i> تواصل معنا
                    </a>
                </nav>
                <a class="site-cta" href="{{ route('site.donations') }}" role="button" aria-label="انتقل لصفحة التبرعات">
                    <i class="bi bi-hand-thumbs-up"></i> تبرع الآن
                </a>
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            @include('admin.partials.flash')
        </div>
        @yield('content')
    </main>

    <footer class="site-footer" role="contentinfo">
        <div class="container">
            <div class="site-footer-grid">
                <div class="footer-section reveal-up">
                    <div class="site-footer-brand">
                        <img src="{{ asset('images/logo-transparent.png') }}" alt="شعار جمعية السلام">
                        <div>
                            <strong>جمعية السلام</strong>
                            <p>{{ $about->summary ?? 'نخدم المجتمع بمبادرات إنسانية مستدامة وقيم التكافل الاجتماعي.' }}</p>
                            <small class="footer-legal">
                                <span>جمعية السلام الإجتماعية بسلامون القماش</span>
                                <span>المشهرة برقم 854 بتاريخ 7/8/1999</span>
                            </small>
                        </div>
                    </div>
                </div>
                
                <div class="footer-section reveal-up delay-1">
                    <h6>روابط سريعة</h6>
                    <ul class="footer-links">
                        <li><a href="{{ route('site.home') }}" title="الذهاب للصفحة الرئيسية">الرئيسية</a></li>
                        <li><a href="{{ route('site.about') }}" title="معرفة المزيد عن الجمعية">عن الجمعية</a></li>
                        <li><a href="{{ route('site.services') }}" title="خدماتنا المختلفة">الخدمات</a></li>
                        <li><a href="{{ route('site.news') }}" title="آخر أخبار الجمعية">الأخبار</a></li>
                        <li><a href="{{ route('site.terms-and-conditions') }}" title="الشروط والأحكام">الشروط والأحكام</a></li>
                        <li><a href="{{ route('site.contact') }}" title="تواصل معنا">اتصل بنا</a></li>
                    </ul>
                </div>
                
                <div class="footer-section reveal-up delay-2">
                    <h6>التبرعات والمساهمات</h6>
                    <p>يمكنك التبرع بشكل عام أو تحديد خدمة بعينها لدعم المشاريع التي تهمك.</p>
                    <a class="site-link site-link--primary" href="{{ route('site.donations') }}" title="اذهب لصفحة التبرعات"><i class="bi bi-hand-thumbs-up"></i> تبرع الآن</a>
                </div>
                
                <div class="footer-section reveal-up delay-3">
                    <h6>تابعنا على وسائل التواصل</h6>
                    <div class="social-links">
                        @php
                            $social = \App\Support\SettingsHelper::getSocialLinks();
                            $icons = [
                                'facebook' => 'facebook',
                                'twitter' => 'twitter',
                                'instagram' => 'instagram',
                                'linkedin' => 'linkedin',
                                'youtube' => 'youtube',
                                'whatsapp' => 'whatsapp',
                            ];
                        @endphp
                        @foreach($social as $key => $link)
                            @if($link && trim($link) !== '')
                                <a href="{{ $key === 'whatsapp' ? 'https://wa.me/' . $link : $link }}"
                                   target="_blank"
                                   rel="noopener"
                                   aria-label="{{ $key }}"
                                   title="تابعنا على {{ $key }}"
                                   class="social-icon social-icon--{{ $key }} reveal-zoom delay-{{ $loop->index + 3 }}">
                                    <i class="bi bi-{{ $icons[$key] }}"></i>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            
            <div class="site-footer-divider"></div>
            
            <div class="site-footer-bottom">
                <p>&copy; {{ date('Y') }} <strong>جمعية السلام</strong> &mdash; جميع الحقوق محفوظة.</p>
                <div class="footer-meta">
                    <a href="{{ route('site.about') }}" title="سياسة الخصوصية">سياسة الخصوصية</a>
                    <span class="divider">&bull;</span>
                    <a href="{{ route('site.terms-and-conditions') }}" title="الشروط والأحكام">الشروط والأحكام</a>
                    <span class="divider">&bull;</span>
                    <a href="{{ route('site.contact') }}" title="اتصل بنا">اتصل بنا</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
