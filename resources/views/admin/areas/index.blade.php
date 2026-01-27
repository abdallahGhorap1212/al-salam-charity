@extends('admin.layouts.app')

@section('title', 'إدارة المناطق')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="text-muted">إجمالي النتائج: {{ $areas->total() }}</div>
        @can('create-areas')
            <a href="{{ route('admin.areas.create') }}" class="btn btn-primary">إضافة منطقة</a>
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
                    @forelse ($areas as $area)
                        <tr>
                            <td>{{ $area->name }}</td>
                            <td>{{ $area->code ?? '-' }}</td>
                            <td>
                                @if ($area->is_active)
                                    <span class="badge bg-success">نشط</span>
                                @else
                                    <span class="badge bg-secondary">غير نشط</span>
                                @endif
                            </td>
                            <td class="text-end">
                                @can('edit-areas')
                                    <a href="{{ route('admin.areas.edit', $area) }}" class="btn btn-sm btn-outline-primary">تعديل</a>
                                @endcan
                                @can('delete-areas')
                                    <form action="{{ route('admin.areas.destroy', $area) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('هل تريد حذف المنطقة؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">حذف</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">لا توجد مناطق.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $areas->withQueryString()->links() }}
    </div>
@endsection
