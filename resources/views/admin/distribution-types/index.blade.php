@extends('admin.layouts.app')

@section('title', 'إدارة أنواع المصروفات')

@section('content')
    <div class="row g-3 align-items-center mb-3">
        <div class="col-lg-8">
            <h6 class="text-muted mb-0">إدارة جميع أنواع المصروفات والمساعدات المتاحة</h6>
        </div>
        <div class="col-lg-4 d-flex justify-content-lg-end">
            <a href="{{ route('admin.distribution-types.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> إضافة نوع جديد
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>النوع (العربية)</th>
                        <th>النوع (English)</th>
                        <th>الأيقونة</th>
                        <th>الوصف</th>
                        <th>الترتيب</th>
                        <th>الحالة</th>
                        <th class="text-end">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($types as $type)
                        <tr>
                            <td>
                                <span class="badge bg-{{ $type->color }}">
                                    {{ $type->ar_name }}
                                </span>
                            </td>
                            <td>{{ $type->name }}</td>
                            <td>
                                <i class="bi {{ $type->icon }} text-{{ $type->color }}"></i>
                            </td>
                            <td>
                                @if ($type->description)
                                    <small class="text-muted">{{ Str::limit($type->description, 40) }}</small>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td><span class="badge bg-light text-dark">{{ $type->order }}</span></td>
                            <td>
                                @if ($type->is_active)
                                    <span class="badge bg-success">نشط</span>
                                @else
                                    <span class="badge bg-secondary">معطّل</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.distribution-types.edit', $type) }}" class="btn btn-sm btn-outline-primary">
                                    تعديل
                                </a>
                                <form action="{{ route('admin.distribution-types.destroy', $type) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('هل تريد حذف هذا النوع؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="bi bi-inbox" style="font-size: 2rem; opacity: 0.3;"></i>
                                <p class="mt-2 mb-0">لا توجد أنواع مصروفات.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $types->links() }}
    </div>
@endsection
