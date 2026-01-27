@extends('admin.layouts.app')

@section('title', 'إدارة الحالات')

@section('content')
    <div class="row g-3 align-items-center mb-3">
        <div class="col-lg-4">
            <form method="GET" action="{{ route('admin.cases.index') }}" class="d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="بحث بالاسم أو الرقم أو الهاتف"
                       value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">بحث</button>
            </form>
        </div>
        <div class="col-lg-8 d-flex justify-content-lg-end flex-wrap gap-2">
            <a href="{{ route('admin.cases.create') }}" class="btn btn-primary">إضافة حالة</a>
            <a href="{{ route('admin.cases.export') }}" class="btn btn-outline-success">تصدير Excel</a>
            <a href="{{ route('admin.cases.export-pdf') }}" class="btn btn-outline-dark">تصدير PDF</a>
            <a href="{{ route('admin.cases.print-all') }}" class="btn btn-outline-info">طباعة جميع البطاقات</a>
            <button class="btn btn-outline-primary" data-bs-toggle="collapse" data-bs-target="#importBox" aria-expanded="false">
                استيراد Excel
            </button>
        </div>
    </div>

    <div class="collapse mb-3" id="importBox">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.cases.import') }}" method="POST" enctype="multipart/form-data" class="d-flex gap-2 flex-wrap">
                    @csrf
                    <input type="file" name="file" class="form-control" required>
                    <button type="submit" class="btn btn-primary">رفع الملف</button>
                    <span class="text-muted">الأعمدة المتوقعة: name, area, case_type</span>
                </form>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>رقم الحالة</th>
                        <th>الاسم</th>
                        <th>المنطقة</th>
                        <th>نوع الحالة</th>
                        <th>عدد الأفراد</th>
                        <th>الملفات</th>
                        <th>الحالة</th>
                        <th class="text-end">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cases as $case)
                        <tr>
                            <td>{{ $case->case_number }}</td>
                            <td>{{ $case->name }}</td>
                            <td>{{ $case->area?->name }}</td>
                            <td>{{ $case->caseType?->name }}</td>
                            <td>{{ $case->family_members_count ?? '-' }}</td>
                            <td>{{ $case->files->count() }}</td>
                            <td>
                                @if ($case->is_active)
                                    <span class="badge bg-success">نشطة</span>
                                @else
                                    <span class="badge bg-secondary">غير نشطة</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.cases.show', $case) }}" class="btn btn-sm btn-outline-info">
                                    <i class="bi bi-eye"></i> الملف
                                </a>
                                <a href="{{ route('admin.cases.edit', $case) }}" class="btn btn-sm btn-outline-primary">تعديل</a>
                                <a href="{{ route('admin.cases.card', $case) }}" class="btn btn-sm btn-outline-dark" target="_blank">طباعة كارت</a>
                                <form action="{{ route('admin.cases.destroy', $case) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('هل تريد حذف الحالة؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-3">لا توجد حالات.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $cases->links() }}
    </div>
@endsection
