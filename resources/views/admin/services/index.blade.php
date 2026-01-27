@extends('admin.layouts.app')

@section('title', 'إدارة الخدمات')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="text-muted">إجمالي النتائج: {{ $services->total() }}</div>
        @can('create-services')
            <a href="{{ route('admin.services.create') }}" class="btn btn-primary">إضافة خدمة</a>
        @endcan
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>الخدمة</th>
                        <th>الحالة</th>
                        <th>الترتيب</th>
                        <th class="text-end">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($services as $service)
                        <tr>
                            <td>{{ $service->title }}</td>
                            <td>
                                @if ($service->is_active)
                                    <span class="badge bg-success">نشط</span>
                                @else
                                    <span class="badge bg-secondary">غير نشط</span>
                                @endif
                            </td>
                            <td>{{ $service->sort_order }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.services.show', $service) }}" class="btn btn-sm btn-outline-secondary">عرض</a>
                                @can('edit-services')
                                    <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-outline-primary">تعديل</a>
                                @endcan
                                @can('delete-services')
                                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('هل تريد حذف الخدمة؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">حذف</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">لا توجد خدمات مسجلة.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $services->withQueryString()->links() }}
    </div>
@endsection
