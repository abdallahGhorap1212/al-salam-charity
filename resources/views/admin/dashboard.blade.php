@extends('admin.layouts.app')

@section('title', 'لوحة التحكم')

@section('content')
    <section class="admin-hero mb-4">
        <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center gap-3">
            <div class="flex-grow-1">
                <h2 class="mb-2">صباح الخير! جاهزين نخدم أهلنا.</h2>
                <p class="mb-0 text-muted">متابعة شاملة للحالات والمساعدات مع لوحة واضحة ومباشرة.</p>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('admin.areas.index') }}" class="btn btn-primary">إدارة المناطق</a>
                <a href="{{ route('admin.case-types.index') }}" class="btn btn-outline-primary">أنواع الحالات</a>
                <button class="btn btn-outline-dark" disabled>إضافة حالة</button>
            </div>
        </div>
    </section>

    <section class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-title">إجمالي الحالات</div>
                <div class="stat-value">{{ $stats['total_cases'] ?? 0 }}</div>
                <div class="stat-sub">ملفات مسجلة</div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card accent">
                <div class="stat-title">الحالات النشطة</div>
                <div class="stat-value">{{ $stats['active_cases'] ?? 0 }}</div>
                <div class="stat-sub">جاهزة للمتابعة</div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card soft">
                <div class="stat-title">عدد المناطق</div>
                <div class="stat-value">{{ $stats['total_areas'] ?? 0 }}</div>
                <div class="stat-sub">نطاقات الخدمة</div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card soft">
                <div class="stat-title">أنواع الحالات</div>
                <div class="stat-value">{{ $stats['total_case_types'] ?? 0 }}</div>
                <div class="stat-sub">تصنيفات الدعم</div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-title">إجمالي المستخدمين</div>
                <div class="stat-value">{{ $stats['total_users'] ?? 0 }}</div>
                <div class="stat-sub">فريق العمل</div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card accent">
                <div class="stat-title">توزيعات المساعدات</div>
                <div class="stat-value">{{ $stats['total_distributions'] ?? 0 }}</div>
                <div class="stat-sub">سجلات الصرف</div>
            </div>
        </div>
    </section>

    <section class="row g-4">
        <div class="col-xl-7">
            <div class="panel-card h-100">
                <div class="panel-header">
                    <div>
                        <h5 class="mb-1">أحدث الحالات</h5>
                        <span>آخر 5 حالات تم تسجيلها في النظام</span>
                    </div>
                    <button class="btn btn-outline-secondary btn-sm" disabled>عرض الكل</button>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>المنطقة</th>
                                <th>نوع الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($stats['recent_cases'] ?? [] as $case)
                                <tr>
                                    <td>{{ $case->name }}</td>
                                    <td>{{ $case->area?->name }}</td>
                                    <td>{{ $case->caseType?->name }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">لا توجد بيانات حتى الآن.</td>
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
                        <h5 class="mb-1">سجل الصرف</h5>
                        <span>آخر عمليات الاستلام المسجلة</span>
                    </div>
                    <button class="btn btn-outline-secondary btn-sm" disabled>عرض الكل</button>
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
                                    <td>{{ optional($distribution->distribution_date)->format('Y-m-d') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">لا توجد بيانات حتى الآن.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
