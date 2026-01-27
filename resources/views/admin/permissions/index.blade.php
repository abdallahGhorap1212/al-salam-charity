@extends('admin.layouts.app')

@section('title', 'إدارة الصلاحيات')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="text-muted">إجمالي النتائج: {{ $permissions->total() }}</div>
        <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary">إضافة صلاحية</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>الصلاحية</th>
                        <th class="text-end">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.permissions.edit', $permission) }}" class="btn btn-sm btn-outline-primary">تعديل</a>
                                <form action="{{ route('admin.permissions.destroy', $permission) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('هل تريد حذف الصلاحية؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center text-muted py-3">لا توجد صلاحيات.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $permissions->withQueryString()->links() }}
    </div>
@endsection
