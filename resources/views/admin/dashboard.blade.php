@extends('admin.layouts.app')

@section('title', 'لوحة التحكم')

@section('content')
    <section class="admin-hero mb-4">
        <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center gap-3">
            <div class="flex-grow-1">
                <h2 class="mb-2">لوحة التحكم</h2>
                <p class="mb-0 text-muted">مرحباً بك. متابعة شاملة للحالات والمساعدات والإحصائيات</p>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('admin.cases.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>إضافة حالة جديدة
                </a>
                <a href="{{ route('admin.distributions.create') }}" class="btn btn-outline-success">
                    <i class="bi bi-plus me-2"></i>تسجيل صرف
                </a>
                <a href="{{ route('admin.reports') }}" class="btn btn-outline-info">
                    <i class="bi bi-file-earmark-pdf me-2"></i>التقارير والفلاتر
                </a>
            </div>
        </div>
    </section>

    <!-- Quick admin links -->
    <section class="row g-3 mb-4">
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('admin.news.index') }}" class="quick-link-card">
                <div class="quick-link-icon">
                    <i class="bi bi-newspaper"></i>
                </div>
                <div class="quick-link-content">
                    <h6>الأخبار</h6>
                    <p>إدارة الأخبار والمنشورات</p>
                </div>
                <i class="bi bi-chevron-left ms-auto"></i>
            </a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('admin.services.index') }}" class="quick-link-card">
                <div class="quick-link-icon">
                    <i class="bi bi-tools"></i>
                </div>
                <div class="quick-link-content">
                    <h6>الخدمات</h6>
                    <p>إدارة الخدمات المقدمة</p>
                </div>
                <i class="bi bi-chevron-left ms-auto"></i>
            </a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('admin.terms-and-conditions.edit') }}" class="quick-link-card">
                <div class="quick-link-icon">
                    <i class="bi bi-file-earmark-text"></i>
                </div>
                <div class="quick-link-content">
                    <h6>الشروط والأحكام</h6>
                    <p>إدارة سياسات الاستخدام</p>
                </div>
                <i class="bi bi-chevron-left ms-auto"></i>
            </a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('admin.about.edit') }}" class="quick-link-card">
                <div class="quick-link-icon">
                    <i class="bi bi-info-circle"></i>
                </div>
                <div class="quick-link-content">
                    <h6>نبذة عنا</h6>
                    <p>معلومات المنظمة</p>
                </div>
                <i class="bi bi-chevron-left ms-auto"></i>
            </a>
        </div>
    </section>
    @if (($stats['alerts'] ?? []) && count($stats['alerts']) > 0)
        <section class="row g-3 mb-4">
            @foreach ($stats['alerts'] as $alert)
                <div class="col-12">
                    <div class="alert alert-{{ $alert['type'] }} alert-dismissible fade show" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-{{ $alert['icon'] }} me-3 fs-5"></i>
                            <div class="flex-grow-1">
                                <h6 class="alert-heading mb-1">{{ $alert['title'] }}</h6>
                                <p class="mb-0">{{ $alert['message'] }}</p>
                            </div>
                            <span class="badge rounded-pill bg-dark ms-3">{{ $alert['count'] }}</span>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endforeach
        </section>
    @endif

    <!-- Main statistics -->
    <section class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-container">
                    <i class="bi bi-folder-check"></i>
                </div>
                <div class="stat-body">
                    <div class="stat-title">إجمالي الحالات</div>
                    <div class="stat-value">{{ $stats['total_cases'] ?? 0 }}</div>
                    <div class="stat-trend" data-direction="{{ $stats['cases_trend']['direction'] ?? 'stable' }}">
                        @if (($stats['cases_trend']['direction'] ?? 'stable') === 'up')
                            <i class="bi bi-arrow-up"></i>
                        @elseif (($stats['cases_trend']['direction'] ?? 'stable') === 'down')
                            <i class="bi bi-arrow-down"></i>
                        @else
                            <i class="bi bi-dash"></i>
                        @endif
                        <span>{{ $stats['cases_trend']['percentage'] ?? '0%' }} من أمس</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card accent">
                <div class="stat-icon-container">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stat-body">
                    <div class="stat-title">الحالات النشطة</div>
                    <div class="stat-value">{{ $stats['active_cases'] ?? 0 }}</div>
                    <div class="stat-sub">جاهزة للمتابعة</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card soft">
                <div class="stat-icon-container">
                    <i class="bi bi-receipt-cutoff"></i>
                </div>
                <div class="stat-body">
                    <div class="stat-title">إجمالي الصرف</div>
                    <div class="stat-value">{{ $stats['total_distributions'] ?? 0 }}</div>
                    <div class="stat-trend" data-direction="{{ $stats['distributions_trend']['direction'] ?? 'stable' }}">
                        @if (($stats['distributions_trend']['direction'] ?? 'stable') === 'up')
                            <i class="bi bi-arrow-up"></i>
                        @elseif (($stats['distributions_trend']['direction'] ?? 'stable') === 'down')
                            <i class="bi bi-arrow-down"></i>
                        @else
                            <i class="bi bi-dash"></i>
                        @endif
                        <span>{{ $stats['distributions_trend']['percentage'] ?? '0%' }} من أمس</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card soft">
                <div class="stat-icon-container">
                    <i class="bi bi-tag"></i>
                </div>
                <div class="stat-body">
                    <div class="stat-title">معدل الحل</div>
                    <div class="stat-value">{{ ($stats['advanced_stats']['resolution_rate'] ?? 0) . '%' }}</div>
                    <div class="stat-sub">من إجمالي الحالات</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Charts -->
    <section class="row g-3 mb-4">
        <div class="col-xl-6">
            <div class="panel-card">
                <div class="panel-header">
                    <div>
                        <h5 class="mb-1">
                            <i class="bi bi-bar-chart me-2"></i>توزيع الحالات حسب المنطقة
                        </h5>
                        <span>توضيح نطاق الخدمة لكل منطقة</span>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="casesByAreaChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="panel-card">
                <div class="panel-header">
                    <div>
                        <h5 class="mb-1">
                            <i class="bi bi-pie-chart me-2"></i>توزيع الحالات حسب النوع
                        </h5>
                        <span>نسبة أنواع الدعم المختلفة</span>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="casesByTypeChart"></canvas>
                </div>
            </div>
        </div>
    </section>

    <!-- Advanced statistics -->
    <section class="row g-3 mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="quick-stat">
                <div class="quick-stat-icon">
                    <i class="bi bi-star"></i>
                </div>
                <div class="quick-stat-body">
                    <div class="quick-stat-label">الحالات اليوم</div>
                    <div class="quick-stat-value">{{ $stats['today_cases'] ?? 0 }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="quick-stat">
                <div class="quick-stat-icon">
                    <i class="bi bi-box-seam"></i>
                </div>
                <div class="quick-stat-body">
                    <div class="quick-stat-label">الصرف اليوم</div>
                    <div class="quick-stat-value">{{ $stats['today_distributions'] ?? 0 }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="quick-stat">
                <div class="quick-stat-icon">
                    <i class="bi bi-hourglass-split"></i>
                </div>
                <div class="quick-stat-body">
                    <div class="quick-stat-label">متوسط الأيام</div>
                    <div class="quick-stat-value">{{ ($stats['advanced_stats']['avg_days_per_case'] ?? 0) . 'ي' }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="quick-stat">
                <div class="quick-stat-icon">
                    <i class="bi bi-people"></i>
                </div>
                <div class="quick-stat-body">
                    <div class="quick-stat-label">المستخدمين</div>
                    <div class="quick-stat-value">{{ $stats['total_users'] ?? 0 }}</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Case analysis -->
    <section class="row g-4 mb-4">
        <div class="col-xl-6">
            <div class="panel-card">
                <div class="panel-header">
                    <div>
                        <h5 class="mb-1">
                            <i class="bi bi-graph-up me-2"></i>تحليل الحالات
                        </h5>
                        <span>إحصائيات شاملة عن معالجة الحالات</span>
                    </div>
                </div>
                <div class="analysis-grid">
                    <div class="analysis-item">
                        <div class="analysis-icon">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="analysis-content">
                            <div class="analysis-label">حالات محلولة</div>
                            <div class="analysis-value">{{ ($stats['advanced_stats']['resolved_cases'] ?? 0) }}</div>
                            <div class="analysis-meta">بنسبة {{ ($stats['advanced_stats']['resolution_rate'] ?? 0) }}%</div>
                        </div>
                    </div>
                    <div class="analysis-item">
                        <div class="analysis-icon" style="background-color: rgba(255, 165, 0, 0.1); color: #ff9800;">
                            <i class="bi bi-hourglass"></i>
                        </div>
                        <div class="analysis-content">
                            <div class="analysis-label">حالات معلقة</div>
                            <div class="analysis-value">{{ ($stats['advanced_stats']['pending_cases'] ?? 0) }}</div>
                            <div class="analysis-meta">بانتظار المتابعة</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="panel-card">
                <div class="panel-header">
                    <div>
                        <h5 class="mb-1">
                            <i class="bi bi-pie-chart me-2"></i>أكثر أنواع الحالات
                        </h5>
                        <span>توزيع الحالات حسب الأولوية</span>
                    </div>
                </div>
                <div class="case-type-list">
                    @forelse (($stats['advanced_stats']['case_type_distribution'] ?? []) as $type)
                        <div class="case-type-item">
                            <div class="case-type-info">
                                <div class="case-type-name">{{ $type['name'] }}</div>
                                <div class="case-type-count">{{ $type['count'] }} حالة</div>
                            </div>
                            <div class="case-type-bar">
                                <div class="case-type-progress" style="width: {{ $type['percentage'] }}%"></div>
                            </div>
                            <div class="case-type-percent">{{ $type['percentage'] }}%</div>
                        </div>
                    @empty
                        <div class="text-center text-muted py-3">لا توجد بيانات</div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- Today's activity -->
    @php $todayActivity = $stats['today_activity'] ?? []; @endphp
    @if (($todayActivity['new_cases'] ?? [])->count() > 0 || ($todayActivity['new_distributions'] ?? [])->count() > 0)
        <section class="row g-4 mb-4">
            @if (($todayActivity['new_cases'] ?? [])->count() > 0)
                <div class="col-xl-6">
                    <div class="panel-card">
                        <div class="panel-header">
                            <div>
                                <h5 class="mb-1">
                                    <i class="bi bi-clock-history me-2"></i>حالات جديدة اليوم
                                </h5>
                                <span>آخر الحالات المضافة</span>
                            </div>
                        </div>
                        <div class="activity-list">
                            @foreach ($todayActivity['new_cases'] as $case)
                                <div class="activity-item">
                                    <div class="activity-badge">
                                        <i class="bi bi-plus"></i>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-title">{{ $case->name }}</div>
                                        <div class="activity-meta">{{ $case->area?->name }} • {{ $case->caseType?->name }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            @if (($todayActivity['new_distributions'] ?? [])->count() > 0)
                <div class="col-xl-6">
                    <div class="panel-card">
                        <div class="panel-header">
                            <div>
                                <h5 class="mb-1">
                                    <i class="bi bi-check-square me-2"></i>عمليات صرف اليوم
                                </h5>
                                <span>آخر التوزيعات المسجلة</span>
                            </div>
                        </div>
                        <div class="activity-list">
                            @foreach ($todayActivity['new_distributions'] as $distribution)
                                <div class="activity-item">
                                    <div class="activity-badge success">
                                        <i class="bi bi-check"></i>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-title">{{ $distribution->case?->name }}</div>
                                        <div class="activity-meta">بواسطة {{ $distribution->user?->name }} • {{ optional($distribution->distribution_date)->format('H:i') }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </section>
    @endif

    <!-- Staff performance -->
    @if (($stats['staff_performance'] ?? []) && count($stats['staff_performance']) > 0)
        <section class="row g-4 mb-4">
            <div class="col-12">
                <div class="panel-card">
                    <div class="panel-header">
                        <div>
                            <h5 class="mb-1">
                                <i class="bi bi-people-fill me-2"></i>أداء الموظفين
                            </h5>
                            <span>معدلات الإنجاز والمعالجة لكل موظف</span>
                        </div>
                        <a href="#" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-graph-up me-1"></i>تقرير مفصل
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>الموظف</th>
                                    <th>الدور</th>
                                    <th>الحالات المسندة</th>
                                    <th>الحالات المحلولة</th>
                                    <th>معدل الحل</th>
                                    <th>عمليات الصرف</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($stats['staff_performance'] as $staff)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-3">
                                                    <span>{{ substr($staff['name'], 0, 1) }}</span>
                                                </div>
                                                <div>{{ $staff['name'] }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark">{{ $staff['role'] }}</span>
                                        </td>
                                        <td>
                                            <strong>{{ $staff['assigned_cases'] }}</strong>
                                        </td>
                                        <td>
                                            <strong class="text-success">{{ $staff['resolved_cases'] }}</strong>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="progress flex-grow-1" style="height: 6px;">
                                                    <div class="progress-bar bg-success" style="width: {{ $staff['resolution_rate'] }}%;"></div>
                                                </div>
                                                <span class="text-muted small">{{ $staff['resolution_rate'] }}%</span>
                                            </div>
                                        </td>
                                        <td>{{ $staff['distributions'] }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            لا توجد بيانات موظفين
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Main tables -->
    <section class="row g-4">
        <div class="col-xl-7">
            <div class="panel-card h-100">
                <div class="panel-header">
                    <div>
                        <h5 class="mb-1">
                            <i class="bi bi-list-ul me-2"></i>أحدث الحالات
                        </h5>
                        <span>آخر 5 حالات تم تسجيلها</span>
                    </div>
                    <a href="{{ route('admin.cases.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-right me-1"></i>عرض الكل
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>المنطقة</th>
                                <th>النوع</th>
                                <th>الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($stats['recent_cases'] ?? [] as $case)
                                <tr>
                                    <td>
                                        <small class="text-muted">{{ $case->case_number }}</small>
                                        <br>{{ $case->name }}
                                    </td>
                                    <td>{{ $case->area?->name }}</td>
                                    <td>{{ $case->caseType?->name }}</td>
                                    <td>
                                        @if ($case->is_active)
                                            <span class="badge bg-success">نشطة</span>
                                        @else
                                            <span class="badge bg-secondary">معطلة</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        لا توجد حالات
                                        <br>
                                        <a href="{{ route('admin.cases.create') }}" class="link-primary small">أضف حالة جديدة</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-5">
            <div class="panel-card h-100">
                <div class="panel-header">
                    <div>
                        <h5 class="mb-1">
                            <i class="bi bi-receipt me-2"></i>سجل الصرف
                        </h5>
                        <span>آخر عمليات الاستلام</span>
                    </div>
                    <a href="{{ route('admin.distributions.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-right me-1"></i>عرض الكل
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>الحالة</th>
                                <th>الموظف</th>
                                <th>التاريخ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($stats['recent_distributions'] ?? [] as $distribution)
                                <tr>
                                    <td>{{ $distribution->case?->name }}</td>
                                    <td>{{ $distribution->user?->name }}</td>
                                    <td>
                                        <small>{{ optional($distribution->distribution_date)->format('d/m H:i') }}</small>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">
                                        لا توجد عمليات صرف
                                        <br>
                                        <a href="{{ route('admin.distributions.create') }}" class="link-primary small">سجل صرف جديد</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        // Chart: case distribution by area
        @if (isset($stats['cases_by_area_chart']))
            const areaCtx = document.getElementById('casesByAreaChart');
            if (areaCtx) {
                new Chart(areaCtx, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($stats['cases_by_area_chart']['labels']) !!},
                        datasets: [{
                            label: 'عدد الحالات',
                            data: {!! json_encode($stats['cases_by_area_chart']['values']) !!},
                            backgroundColor: 'rgba(15, 91, 95, 0.7)',
                            borderColor: 'rgba(15, 91, 95, 1)',
                            borderWidth: 1,
                            borderRadius: 4,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { stepSize: 1 }
                            }
                        }
                    }
                });
            }
        @endif

        // Chart: case distribution by type
        @if (isset($stats['cases_by_type_chart']))
            const typeCtx = document.getElementById('casesByTypeChart');
            if (typeCtx) {
                new Chart(typeCtx, {
                    type: 'doughnut',
                    data: {
                        labels: {!! json_encode($stats['cases_by_type_chart']['labels']) !!},
                        datasets: [{
                            data: {!! json_encode($stats['cases_by_type_chart']['values']) !!},
                            backgroundColor: [
                                'rgba(15, 91, 95, 0.8)',
                                'rgba(76, 175, 80, 0.8)',
                                'rgba(255, 152, 0, 0.8)',
                                'rgba(244, 67, 54, 0.8)',
                                'rgba(103, 58, 183, 0.8)',
                                'rgba(0, 188, 212, 0.8)',
                            ],
                            borderColor: 'white',
                            borderWidth: 2,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: { font: { size: 12 } }
                            }
                        }
                    }
                });
            }
        @endif
    </script>
@endpush
