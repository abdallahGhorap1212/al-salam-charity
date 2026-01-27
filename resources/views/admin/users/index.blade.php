@extends('admin.layouts.app')

@section('title', 'إدارة المستخدمين')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="text-muted">إجمالي النتائج: {{ $users->total() }}</div>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">إضافة مستخدم</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>الاسم</th>
                        <th>البريد</th>
                        <th>الأدوار</th>
                        <th class="text-end">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->roles->isNotEmpty())
                                    {{ $user->roles->pluck('name')->implode('، ') }}
                                @else
                                    <span class="text-muted">بدون دور</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-primary">تعديل</a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('هل تريد حذف المستخدم؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">لا يوجد مستخدمون.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $users->withQueryString()->links() }}
    </div>
@endsection
