@extends('admin.layouts.app')

@section('title', 'ملف الحالة - ' . $case->name)

@section('content')
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">ملف الحالة - {{ $case->name }}</h1>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.cases.edit', $case) }}" class="btn btn-outline-primary">
                    <i class="bi bi-pencil"></i> تعديل
                </a>
                <a href="{{ route('admin.cases.card', $case) }}" class="btn btn-outline-dark" target="_blank">
                    <i class="bi bi-printer"></i> طباعة كارت
                </a>
                <a href="{{ route('admin.cases.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-right"></i> العودة
                </a>
            </div>
        </div>
    </div>

    <!-- Main Case Information -->
    <div class="row g-3 mb-4">
        <!-- Basic Info -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-light border-0">
                    <h5 class="mb-0">
                        <i class="bi bi-file-person"></i> المعلومات الأساسية
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label text-muted small">رقم الحالة</label>
                            <p class="mb-0 fw-bold">{{ $case->case_number }}</p>
                        </div>
                        <div class="col-12">
                            <label class="form-label text-muted small">الاسم الكامل</label>
                            <p class="mb-0 fw-bold text-dark">{{ $case->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small">رقم الهوية</label>
                            <p class="mb-0 fw-bold">{{ $case->national_id ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small">الهاتف</label>
                            <p class="mb-0 fw-bold">{{ $case->phone ?? '-' }}</p>
                        </div>
                        <div class="col-12">
                            <label class="form-label text-muted small">العنوان</label>
                            <p class="mb-0">{{ $case->address ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small">المنطقة</label>
                            <p class="mb-0 fw-bold">{{ $case->area?->name ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small">نوع الحالة</label>
                            <p class="mb-0 fw-bold">{{ $case->caseType?->name ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small">عدد أفراد الأسرة</label>
                            <p class="mb-0 fw-bold">{{ $case->family_members_count ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small">الحالة الحالية</label>
                            <p class="mb-0">
                                @if ($case->is_active)
                                    <span class="badge bg-success">نشطة</span>
                                @else
                                    <span class="badge bg-secondary">غير نشطة</span>
                                @endif
                            </p>
                        </div>
                        @if ($case->user)
                            <div class="col-12">
                                <label class="form-label text-muted small">الموظف المسؤول</label>
                                <p class="mb-0 fw-bold">{{ $case->user->name }}</p>
                            </div>
                        @endif
                        @if ($case->notes)
                            <div class="col-12">
                                <label class="form-label text-muted small">ملاحظات</label>
                                <p class="mb-0 text-secondary">{{ $case->notes }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-light border-0">
                    <h5 class="mb-0">
                        <i class="bi bi-bar-chart"></i> إحصائيات الصرفيات
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center g-3">
                        <!-- Total Cash Aid -->
                        @php
                            $totalCashAid = $case->aidDistributions->sum('amount');
                        @endphp
                        <div class="col-12">
                            <div class="p-3 rounded" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white;">
                                <div class="h6 mb-2">إجمالي المساعدات المالية</div>
                                <div class="h3 mb-0 fw-bold">{{ number_format($totalCashAid, 2) }} <small>EGP</small></div>
                            </div>
                        </div>

                        <!-- Total Distributions -->
                        <div class="col-md-6">
                            <div class="p-3 rounded bg-light">
                                <div class="h6 text-muted mb-2">إجمالي الصرفيات</div>
                                <div class="h2 mb-0 text-primary fw-bold">{{ $totalDistributions }}</div>
                                <small class="text-muted">مرات الاستلام</small>
                            </div>
                        </div>

                        <!-- Last Distribution -->
                        <div class="col-md-6">
                            <div class="p-3 rounded bg-light">
                                <div class="h6 text-muted mb-2">آخر استلام</div>
                                @if ($lastDistribution)
                                    <div class="h6 mb-2">{{ $lastDistribution->distribution_date->format('d/m/Y') }}</div>
                                    <small class="text-muted">{{ $lastDistribution->distribution_date->diffForHumans() }}</small>
                                @else
                                    <p class="text-secondary mb-0">لا توجد صرفيات</p>
                                @endif
                            </div>
                        </div>

                        <!-- First Distribution -->
                        <div class="col-md-6">
                            <div class="p-3 rounded bg-light">
                                <div class="h6 text-muted mb-2">أول استلام</div>
                                @if ($firstDistribution)
                                    <div class="h6 mb-2">{{ $firstDistribution->distribution_date->format('d/m/Y') }}</div>
                                    <small class="text-muted">
                                        منذ {{ $firstDistribution->distribution_date->diffInDays(now()) }} يوم
                                    </small>
                                @else
                                    <p class="text-secondary mb-0">لا توجد صرفيات</p>
                                @endif
                            </div>
                        </div>

                        <!-- Distribution Frequency -->
                        <div class="col-md-6">
                            <div class="p-3 rounded bg-light">
                                <div class="h6 text-muted mb-2">متوسط التكرار</div>
                                @if ($totalDistributions > 1 && $firstDistribution && $lastDistribution)
                                    @php
                                        $daysBetween = $lastDistribution->distribution_date->diffInDays(
                                            $firstDistribution->distribution_date
                                        );
                                        $frequency = $daysBetween > 0 ? round($daysBetween / ($totalDistributions - 1)) : 0;
                                    @endphp
                                    <div class="h6 mb-2">{{ $frequency > 0 ? $frequency : 'نفس اليوم' }}</div>
                                    <small class="text-muted">يوم بين كل صرفية</small>
                                @else
                                    <p class="text-secondary mb-0">بيانات غير كافية</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Distribution Summary by Type -->
    @if ($case->aidDistributions->count() > 0)
        <div class="mb-4">
            <h6 class="mb-3 text-muted">
                <i class="bi bi-card-checklist"></i> ملخص المساعدات حسب النوع
            </h6>
            <div class="row g-3">
                @php
                    $typeBreakdown = $case->aidDistributions->groupBy('distribution_type_id');
                    $types = \App\Models\DistributionType::whereIn('id', $typeBreakdown->keys())->orderBy('order')->get();
                @endphp
                @foreach ($types as $type)
                    @php
                        $typeDistributions = $typeBreakdown->get($type->id, collect());
                        $count = $typeDistributions->count();
                        $totalAmount = $typeDistributions->sum('amount');
                        $avgAmount = $totalAmount > 0 ? $totalAmount / $count : 0;
                    @endphp
                    <div class="col-lg-3 col-md-6">
                        <div class="card border-0 shadow-sm h-100 border-start border-{{ $type->color }}" style="border-width: 4px;">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="rounded-circle p-2 me-2" style="background-color: var(--bs-{{ $type->color }});opacity:0.2;">
                                        <i class="bi {{ $type->icon }} text-{{ $type->color }}" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 text-truncate">{{ $type->ar_name }}</h6>
                                        <small class="text-muted">{{ $type->name }}</small>
                                    </div>
                                </div>
                                
                                <div class="mb-2">
                                    <small class="text-muted d-block mb-1">عدد المرات</small>
                                    <div class="h5 mb-0">
                                        <span class="badge bg-{{ $type->color }}">{{ $count }}</span>
                                    </div>
                                </div>
                                
                                @if ($totalAmount > 0)
                                    <hr class="my-2">
                                    <div class="mb-2">
                                        <small class="text-muted d-block mb-1">الإجمالي المالي</small>
                                        <div class="h6 mb-0 text-success fw-bold">{{ number_format($totalAmount, 2) }} EGP</div>
                                    </div>
                                    @if ($count > 1)
                                        <div>
                                            <small class="text-muted d-block mb-1">المتوسط</small>
                                            <div class="small">{{ number_format($avgAmount, 2) }} EGP</div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Distribution History -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-light border-0">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-clock-history"></i> سجل الصرفيات التفصيلي
                </h5>
                <a href="{{ route('admin.distributions.create') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus"></i> إضافة صرفية
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>النوع</th>
                        <th>تاريخ الصرفية</th>
                        <th>المبلغ</th>
                        <th>الموظف المسؤول</th>
                        <th>الملاحظات</th>
                        <th>منذ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($case->aidDistributions as $index => $distribution)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if ($distribution->type)
                                    <span class="badge bg-{{ $distribution->type->color }}">
                                        {{ $distribution->type->ar_name }}
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $distribution->distribution_date->format('d/m/Y') }}</strong>
                                <br>
                                <small class="text-muted">{{ $distribution->distribution_date->format('H:i') }}</small>
                            </td>
                            <td>
                                @if ($distribution->amount)
                                    <span class="fw-bold text-success">{{ number_format($distribution->amount, 2) }} {{ $distribution->currency }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if ($distribution->user)
                                    <span class="badge bg-info">{{ $distribution->user->name }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if ($distribution->notes)
                                    <span class="text-muted">{{ Str::limit($distribution->notes, 50) }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted">{{ $distribution->distribution_date->diffForHumans() }}</small>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="bi bi-inbox" style="font-size: 2rem; opacity: 0.3;"></i>
                                <p class="mt-2 mb-0">لا توجد صرفيات لهذه الحالة</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Distribution Details by Type -->
    @if ($case->aidDistributions->count() > 0)
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-header bg-light border-0">
                <h5 class="mb-0">
                    <i class="bi bi-diagram-3"></i> تفاصيل الصرفيات حسب النوع
                </h5>
            </div>
            <div class="card-body">
                <div class="accordion" id="distributionAccordion">
                    @php
                        $typeBreakdown = $case->aidDistributions->groupBy('distribution_type_id');
                        $types = \App\Models\DistributionType::whereIn('id', $typeBreakdown->keys())->orderBy('order')->get();
                    @endphp
                    @foreach ($types as $type)
                        @php
                            $typeDistributions = $typeBreakdown->get($type->id, collect())->sortByDesc('distribution_date');
                            $totalAmount = $typeDistributions->sum('amount');
                            $count = $typeDistributions->count();
                        @endphp
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed w-100" type="button" data-bs-toggle="collapse" 
                                        data-bs-target="#type{{ $type->id }}">
                                    <div class="w-100 d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <i class="bi {{ $type->icon }} me-2 text-{{ $type->color }}"></i>
                                            <strong>{{ $type->ar_name }}</strong>
                                        </div>
                                        <div class="d-flex align-items-center gap-3 ms-auto">
                                            <span class="badge bg-{{ $type->color }}">{{ $count }} مرة</span>
                                            @if ($totalAmount > 0)
                                                <div class="text-end">
                                                    <div class="small text-muted">الإجمالي</div>
                                                    <strong class="text-success">{{ number_format($totalAmount, 2) }} EGP</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </button>
                            </h2>
                            <div id="type{{ $type->id }}" class="accordion-collapse collapse" data-bs-parent="#distributionAccordion">
                                <div class="accordion-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-sm mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th width="20%">التاريخ</th>
                                                    <th width="20%">المبلغ</th>
                                                    <th width="25%">الموظف</th>
                                                    <th width="35%">الملاحظات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($typeDistributions as $dist)
                                                    <tr>
                                                        <td>
                                                            <strong>{{ $dist->distribution_date->format('d/m/Y') }}</strong>
                                                            <br>
                                                            <small class="text-muted">{{ $dist->distribution_date->format('H:i') }}</small>
                                                        </td>
                                                        <td>
                                                            @if ($dist->amount)
                                                                <span class="fw-bold text-success">{{ number_format($dist->amount, 2) }}</span>
                                                            @else
                                                                <span class="text-muted">-</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($dist->user)
                                                                <small>{{ $dist->user->name }}</small>
                                                            @else
                                                                <span class="text-muted">-</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($dist->notes)
                                                                <small class="text-muted">{{ Str::limit($dist->notes, 40) }}</small>
                                                            @else
                                                                <span class="text-muted">-</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @if ($totalAmount > 0)
                                                    <tr class="table-active fw-bold">
                                                        <td colspan="2" class="text-end pe-3">الإجمالي:</td>
                                                        <td class="text-success">{{ number_format($totalAmount, 2) }} EGP</td>
                                                        <td colspan="2"></td>
                                                    </tr>
                                                    @if ($count > 1)
                                                        <tr class="table-light small">
                                                            <td colspan="2" class="text-end pe-3">المتوسط:</td>
                                                            <td>{{ number_format($totalAmount / $count, 2) }} EGP</td>
                                                            <td colspan="2"></td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Additional Information -->
    @if ($case->files->count() > 0)
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-header bg-light border-0">
                <h5 class="mb-0">
                    <i class="bi bi-files"></i> الملفات المرفقة ({{ $case->files->count() }})
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    @foreach ($case->files as $file)
                        <div class="col-md-6 col-lg-4">
                            <div class="card border-0 bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">{{ $file->name ?? 'ملف' }}</h6>
                                    <p class="card-text small text-muted mb-2">
                                        تم الإضافة:
                                        {{ $file->created_at->format('d/m/Y') }}
                                    </p>
                                    @if ($file->path)
                                        <a href="{{ Storage::url($file->path) }}" class="btn btn-sm btn-outline-primary" download>
                                            <i class="bi bi-download"></i> تحميل
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Metadata -->
    <div class="card border-0 shadow-sm mt-4">
        <div class="card-header bg-light border-0">
            <h5 class="mb-0">
                <i class="bi bi-info-circle"></i> معلومات النظام
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p class="text-muted mb-1"><small>تاريخ الإنشاء</small></p>
                    <p class="fw-bold">{{ $case->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="col-md-6">
                    <p class="text-muted mb-1"><small>آخر تحديث</small></p>
                    <p class="fw-bold">{{ $case->updated_at->format('d/m/Y H:i') }}</p>
                </div>
                @if ($case->barcode)
                    <div class="col-md-6">
                        <p class="text-muted mb-1"><small>الباركود</small></p>
                        <p class="fw-bold font-monospace">{{ $case->barcode }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
