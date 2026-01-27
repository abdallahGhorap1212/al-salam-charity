<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'جمعية السلام' }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Changa:400,600,700,800|Cairo:300,400,600,700" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="site-shell">
    <header class="site-header">
        <div class="container">
            <div class="site-header-inner">
                <a class="site-brand" href="{{ route('site.home') }}">
                    <img src="{{ asset('images/logo-transparent.png') }}" alt="جمعية السلام">
                    <span>
                        <strong>جمعية السلام</strong>
                        <small>معًا لنصنع أثرًا حقيقيًا</small>
                    </span>
                </a>
                <nav class="site-nav">
                    <a href="{{ route('site.home') }}" class="{{ request()->routeIs('site.home') ? 'active' : '' }}">الرئيسية</a>
                    <a href="{{ route('site.about') }}" class="{{ request()->routeIs('site.about') ? 'active' : '' }}">نبذة عنا</a>
                    <a href="{{ route('site.services') }}" class="{{ request()->routeIs('site.services*') ? 'active' : '' }}">الخدمات</a>
                    <a href="{{ route('site.news') }}" class="{{ request()->routeIs('site.news*') ? 'active' : '' }}">الأخبار</a>
                    <a href="{{ route('site.contact') }}" class="{{ request()->routeIs('site.contact') ? 'active' : '' }}">تواصل معنا</a>
                </nav>
                <a class="site-cta" href="{{ route('site.donations') }}">تبرع الآن</a>
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            @include('admin.partials.flash')
        </div>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container">
            <div class="site-footer-grid">
                <div>
                    <div class="site-footer-brand">
                        <img src="{{ asset('images/logo-transparent.png') }}" alt="جمعية السلام">
                        <div>
                            <strong>جمعية السلام</strong>
                            <p>نخدم المجتمع بمبادرات إنسانية مستدامة.</p>
                        </div>
                    </div>
                </div>
                <div>
                    <h6>روابط سريعة</h6>
                    <ul>
                        <li><a href="{{ route('site.about') }}">نبذة عن الجمعية</a></li>
                        <li><a href="{{ route('site.services') }}">خدماتنا</a></li>
                        <li><a href="{{ route('site.news') }}">الأخبار</a></li>
                        <li><a href="{{ route('site.contact') }}">تواصل معنا</a></li>
                    </ul>
                </div>
                <div>
                    <h6>التبرعات</h6>
                    <p>يمكنك التبرع بشكل عام أو تحديد خدمة بعينها.</p>
                    <a class="site-link" href="{{ route('site.donations') }}">انتقل لصفحة التبرعات</a>
                </div>
            </div>
            <div class="site-footer-bottom">© {{ date('Y') }} جمعية السلام. جميع الحقوق محفوظة.</div>
        </div>
    </footer>
</body>
</html>
