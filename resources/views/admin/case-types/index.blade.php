@extends('admin.layouts.app')

@section('title', 'إدارة أنواع الحالات')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="text-muted">إجمالي النتائج: {{ $caseTypes->total() }}</div>
        @can('create-case-types')
            <a href="{{ route('admin.case-types.create') }}" class="btn btn-primary">إضافة نوع</a>
        @endcan
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>الاسم</th>
                        <th>الكود</th>
                        <th>الحالة</th>
                        <th class="text-end">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($caseTypes as $caseType)
                        <tr>
                            <td>{{ $caseType->name }}</td>
                            <td>{{ $caseType->code ?? '-' }}</td>
                            <td>
                                @if ($caseType->is_active)
                                    <span class="badge bg-success">نشط</span>
                                @else
                                    <span class="badge bg-secondary">غير نشط</span>
                                @endif
                            </td>
                            <td class="text-end">
                                @can('edit-case-types')
                                    <a href="{{ route('admin.case-types.edit', $caseType) }}" class="btn btn-sm btn-outline-primary">تعديل</a>
                                @endcan
                                @can('delete-case-types')
                                    <form action="{{ route('admin.case-types.destroy', $caseType) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('هل تريد حذف النوع؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">حذف</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">لا توجد أنواع مسجلة.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $caseTypes->withQueryString()->links() }}
    </div>
@endsection
