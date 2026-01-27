@extends('admin.layouts.app')

@section('title', 'إدارة الأدوار')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="text-muted">إجمالي النتائج: {{ $roles->total() }}</div>
        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">إضافة دور</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>الدور</th>
                        <th>عدد الصلاحيات</th>
                        <th class="text-end">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->permissions->count() }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-sm btn-outline-primary">تعديل</a>
                                <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('هل تريد حذف الدور؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-3">لا توجد أدوار.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $roles->withQueryString()->links() }}
    </div>
@endsection
