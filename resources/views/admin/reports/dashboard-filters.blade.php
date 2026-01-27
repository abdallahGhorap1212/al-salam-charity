@extends('admin.layouts.app')

@section('title', 'التقارير والفلاتر')

@section('content')
    <section class="admin-hero mb-4">
        <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center gap-3">
            <div class="flex-grow-1">
                <h2 class="mb-2">التقارير والفلاتر</h2>
                <p class="mb-0 text-muted">اعرض بيانات الحالات والصرفيات مع خيارات فلترة متقدمة</p>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <button class="btn btn-primary" id="exportBtn">
                    <i class="bi bi-download me-2"></i>تصدير إلى Excel
                </button>
                <button class="btn btn-outline-secondary" id="printBtn">
                    <i class="bi bi-printer me-2"></i>طباعة
                </button>
            </div>
        </div>
    </section>

    <!-- نموذج الفلاتر -->
    <div class="panel-card mb-4">
        <div class="panel-header">
            <div>
                <h5 class="mb-1">
                    <i class="bi bi-funnel me-2"></i>خيارات التصفية
                </h5>
                <span>حدد معايير البحث لتصفية البيانات</span>
            </div>
        </div>
        <form id="filterForm" class="p-4">
            <div class="row g-3">
                <div class="col-md-6 col-lg-3">
                    <label class="form-label">من التاريخ</label>
                    <input type="date" class="form-control" name="from_date" id="fromDate">
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="form-label">إلى التاريخ</label>
                    <input type="date" class="form-control" name="to_date" id="toDate">
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="form-label">المنطقة</label>
                    <select class="form-select" name="area_id" id="areaFilter">
                        <option value="">جميع المناطق</option>
                        @foreach (\App\Models\Area::all() as $area)
                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="form-label">نوع الحالة</label>
                    <select class="form-select" name="case_type_id" id="caseTypeFilter">
                        <option value="">جميع الأنواع</option>
                        @foreach (\App\Models\CaseType::all() as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="form-label">الموظف</label>
                    <select class="form-select" name="user_id" id="userFilter">
                        <option value="">جميع الموظفين</option>
                        @foreach (\App\Models\User::orderBy('name')->get() as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="form-label">حالة الملف</label>
                    <select class="form-select" name="status" id="statusFilter">
                        <option value="">جميع الحالات</option>
                        <option value="active">نشطة</option>
                        <option value="inactive">معطلة</option>
                        <option value="resolved">محلولة</option>
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search me-2"></i>تطبيق الفلاتر
                    </button>
                    <button type="reset" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-clockwise me-2"></i>إعادة تعيين
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- جدول الحالات -->
    <div class="panel-card mb-4">
        <div class="panel-header">
            <div>
                <h5 class="mb-1">
                    <i class="bi bi-list-ul me-2"></i>قائمة الحالات
                </h5>
                <span id="caseCount">جاري التحميل...</span>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table align-middle mb-0" id="casesTable">
                <thead>
                    <tr>
                        <th>رقم الملف</th>
                        <th>الاسم</th>
                        <th>المنطقة</th>
                        <th>نوع الحالة</th>
                        <th>الموظف</th>
                        <th>عدد الصرفيات</th>
                        <th>الحالة</th>
                        <th>التاريخ</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- سيتم ملء البيانات من JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- إحصائيات الفلاتر -->
    <div class="row g-3">
        <div class="col-md-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon-container">
                    <i class="bi bi-folder"></i>
                </div>
                <div class="stat-body">
                    <div class="stat-title">إجمالي الحالات</div>
                    <div class="stat-value" id="totalCases">0</div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="stat-card accent">
                <div class="stat-icon-container">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stat-body">
                    <div class="stat-title">حالات نشطة</div>
                    <div class="stat-value" id="activeCases">0</div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="stat-card soft">
                <div class="stat-icon-container">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div class="stat-body">
                    <div class="stat-title">حالات محلولة</div>
                    <div class="stat-value" id="resolvedCases">0</div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="stat-card soft">
                <div class="stat-icon-container">
                    <i class="bi bi-receipt"></i>
                </div>
                <div class="stat-body">
                    <div class="stat-title">إجمالي الصرفيات</div>
                    <div class="stat-value" id="totalDistributions">0</div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                loadData();

                document.getElementById('filterForm').addEventListener('submit', function(e) {
                    e.preventDefault();
                    loadData();
                });

                document.getElementById('exportBtn').addEventListener('click', function() {
                    exportToExcel();
                });

                document.getElementById('printBtn').addEventListener('click', function() {
                    window.print();
                });
            });

            async function loadData() {
                const formData = new FormData(document.getElementById('filterForm'));
                const params = new URLSearchParams(formData);
                
                try {
                    const response = await fetch('/admin/api/cases?' + params, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    
                    const data = await response.json();
                    
                    // Update table
                    const tbody = document.querySelector('#casesTable tbody');
                    tbody.innerHTML = '';
                    
                    data.cases.forEach(caseItem => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${caseItem.case_number}</td>
                            <td>${caseItem.name}</td>
                            <td>${caseItem.area?.name || '-'}</td>
                            <td>${caseItem.case_type?.name || '-'}</td>
                            <td>${caseItem.user?.name || '-'}</td>
                            <td>${caseItem.aid_distributions_count || 0}</td>
                            <td>
                                <span class="badge ${caseItem.is_active ? 'bg-success' : 'bg-secondary'}">
                                    ${caseItem.is_active ? 'نشطة' : 'معطلة'}
                                </span>
                            </td>
                            <td><small>${new Date(caseItem.created_at).toLocaleDateString('ar-EG')}</small></td>
                        `;
                        tbody.appendChild(row);
                    });
                    
                    // Update statistics
                    document.getElementById('caseCount').textContent = `إجمالي: ${data.total} حالة`;
                    document.getElementById('totalCases').textContent = data.total;
                    document.getElementById('activeCases').textContent = data.active;
                    document.getElementById('resolvedCases').textContent = data.resolved;
                    document.getElementById('totalDistributions').textContent = data.distributions;
                    
                } catch (error) {
                    console.error('Error loading data:', error);
                    alert('حدث خطأ في تحميل البيانات');
                }
            }

            function exportToExcel() {
                const table = document.getElementById('casesTable');
                const ws = XLSX.utils.table_to_sheet(table);
                const wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, "Cases");
                XLSX.writeFile(wb, "report_" + new Date().toISOString().split('T')[0] + ".xlsx");
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
    @endpush
@endsection
