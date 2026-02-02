<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'جمعية السلام') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Cairo:300,400,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="admin-shell">
    <header class="admin-topbar">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3">
                    <a class="admin-brand d-flex align-items-center gap-2" href="{{ route('admin.dashboard') }}">
                        <img src="{{ asset('images/logo-transparent.png') }}" alt="جمعية السلام" class="admin-logo">
                        جمعية السلام
                    </a>
                    <span class="admin-tagline">لوحة إدارة الجمعية الخيرية</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="admin-user">{{ Auth::user()->name ?? 'المستخدم' }}</span>
                    <div class="dropdown">
                        <button class="btn btn-outline-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            الحساب
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    تسجيل الخروج
                                </a>
                            </li>
                        </ul>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <aside class="col-lg-2 col-md-3 admin-sidebar p-0">
                <div class="admin-menu">
                    <!-- Home -->
                    <a href="{{ route('admin.dashboard') }}" class="admin-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i>
                        لوحة التحكم
                    </a>

                    <!-- Cases and beneficiaries management -->
                    <div class="menu-section">
                        <h6 class="menu-section-title">إدارة الحالات</h6>
                        @can('view-case-types')
                            <a href="{{ route('admin.case-types.index') }}" class="admin-link {{ request()->routeIs('admin.case-types.*') ? 'active' : '' }}">
                                <i class="bi bi-tags me-2"></i>
                                أنواع الحالات
                            </a>
                        @endcan
                        @can('view-areas')
                            <a href="{{ route('admin.areas.index') }}" class="admin-link {{ request()->routeIs('admin.areas.*') ? 'active' : '' }}">
                                <i class="bi bi-geo-alt me-2"></i>
                                المناطق
                            </a>
                        @endcan
                        @can('view-cases')
                            <a href="{{ route('admin.cases.index') }}" class="admin-link {{ request()->routeIs('admin.cases.*') ? 'active' : '' }}">
                                <i class="bi bi-folder-check me-2"></i>
                                الحالات والملفات
                            </a>
                        @endcan
                        @can('view-distributions')
                            <a href="{{ route('admin.distributions.index') }}" class="admin-link {{ request()->routeIs('admin.distributions.*') ? 'active' : '' }}">
                                <i class="bi bi-box-seam me-2"></i>
                                الصرف والباركود
                            </a>
                        @endcan
                        @can('manage-distribution-types')
                            <a href="{{ route('admin.distribution-types.index') }}" class="admin-link {{ request()->routeIs('admin.distribution-types.*') ? 'active' : '' }}">
                                <i class="bi bi-tags me-2"></i>
                                أنواع المصروفات
                            </a>
                        @endcan
                        @can('view-reports')
                            <a href="{{ route('admin.reports') }}" class="admin-link {{ request()->routeIs('admin.reports') ? 'active' : '' }}">
                                <i class="bi bi-graph-up me-2"></i>
                                التقارير والإحصائيات
                            </a>
                        @endcan
                    </div>

                    <!-- Content management -->
                    <div class="menu-section">
                        <h6 class="menu-section-title">إدارة المحتوى</h6>
                        @can('view-news')
                            <a href="{{ route('admin.news.index') }}" class="admin-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                                <i class="bi bi-newspaper me-2"></i>
                                الأخبار
                            </a>
                        @endcan
                        @can('view-services')
                            <a href="{{ route('admin.services.index') }}" class="admin-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                                <i class="bi bi-briefcase me-2"></i>
                                الخدمات
                            </a>
                        @endcan
                        @can('view-about')
                            <a href="{{ route('admin.about.edit') }}" class="admin-link {{ request()->routeIs('admin.about.*') ? 'active' : '' }}">
                                <i class="bi bi-info-circle me-2"></i>
                                نبذة عن الجمعية
                            </a>
                        @endcan
                        @can('view-terms-and-conditions')
                            <a href="{{ route('admin.terms-and-conditions.edit') }}" class="admin-link {{ request()->routeIs('admin.terms-and-conditions.*') ? 'active' : '' }}">
                                <i class="bi bi-file-earmark-text me-2"></i>
                                الشروط والأحكام
                            </a>
                        @endcan
                        @can('view-board-members')
                            <a href="{{ route('admin.board-members.index') }}" class="admin-link {{ request()->routeIs('admin.board-members.*') ? 'active' : '' }}">
                                <i class="bi bi-people me-2"></i>
                                مجلس الإدارة
                            </a>
                        @endcan
                    </div>

                    <!-- Interactions management -->
                    <div class="menu-section">
                        <h6 class="menu-section-title">التفاعلات</h6>
                        @can('view-contact-messages')
                            <a href="{{ route('admin.contact-messages.index') }}" class="admin-link {{ request()->routeIs('admin.contact-messages.*') ? 'active' : '' }}">
                                <i class="bi bi-chat-dots me-2"></i>
                                رسائل التواصل
                            </a>
                        @endcan
                        @can('view-donation-requests')
                            <a href="{{ route('admin.donation-requests.index') }}" class="admin-link {{ request()->routeIs('admin.donation-requests.*') ? 'active' : '' }}">
                                <i class="bi bi-gift me-2"></i>
                                طلبات التبرع
                            </a>
                        @endcan
                    </div>

                    <!-- System management -->
                    <div class="menu-section">
                        <h6 class="menu-section-title">إدارة النظام</h6>
                        @can('view-users')
                            <a href="{{ route('admin.users.index') }}" class="admin-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                                <i class="bi bi-person-gear me-2"></i>
                                المستخدمين
                            </a>
                        @endcan
                        @can('view-roles')
                            <a href="{{ route('admin.roles.index') }}" class="admin-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                                <i class="bi bi-shield-check me-2"></i>
                                الأدوار
                            </a>
                        @endcan
                        @can('view-roles')
                            <a href="{{ route('admin.permissions.index') }}" class="admin-link {{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}">
                                <i class="bi bi-lock me-2"></i>
                                الصلاحيات
                            </a>
                        @endcan
                        @can('view-settings')
                            <a href="{{ route('admin.settings.index') }}" class="admin-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                                <i class="bi bi-sliders me-2"></i>
                                الإعدادات
                            </a>
                        @endcan
                    </div>
                </div>
            </aside>
            <main class="col-lg-10 col-md-9 p-4 admin-content">
                <div class="admin-titlebar">
                    <h1 class="h3 mb-1">@yield('title')</h1>
                    <p class="text-muted mb-0">إدارة سريعة ومتابعة دقيقة لكل أعمال الجمعية.</p>
                </div>
                @include('admin.partials.flash')
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
