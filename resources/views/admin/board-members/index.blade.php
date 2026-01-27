@extends('admin.layouts.app')

@section('title', 'أعضاء مجلس الإدارة')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="text-muted">إجمالي النتائج: {{ $boardMembers->total() }}</div>
        @can('create-board-members')
            <a href="{{ route('admin.board-members.create') }}" class="btn btn-primary">إضافة عضو</a>
        @endcan
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>الاسم</th>
                        <th>المنصب</th>
                        <th>الحالة</th>
                        <th>الترتيب</th>
                        <th class="text-end">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($boardMembers as $member)
                        <tr>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->role ?? '-' }}</td>
                            <td>
                                @if ($member->is_active)
                                    <span class="badge bg-success">نشط</span>
                                @else
                                    <span class="badge bg-secondary">غير نشط</span>
                                @endif
                            </td>
                            <td>{{ $member->sort_order }}</td>
                            <td class="text-end">
                                @can('edit-board-members')
                                    <a href="{{ route('admin.board-members.edit', $member) }}" class="btn btn-sm btn-outline-primary">تعديل</a>
                                @endcan
                                @can('delete-board-members')
                                    <form action="{{ route('admin.board-members.destroy', $member) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('هل تريد حذف العضو؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">حذف</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">لا يوجد أعضاء مسجلين.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $boardMembers->withQueryString()->links() }}
    </div>
@endsection
