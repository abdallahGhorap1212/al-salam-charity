@extends('admin.layouts.app')

@section('title', 'رسائل التواصل')

@section('content')
    <div class="text-muted mb-3">إجمالي النتائج: {{ $messages->total() }}</div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>المرسل</th>
                        <th>البريد</th>
                        <th>الهاتف</th>
                        <th>الحالة</th>
                        <th>التاريخ</th>
                        <th class="text-end">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($messages as $message)
                        <tr>
                            <td>{{ $message->name }}</td>
                            <td>{{ $message->email ?? '-' }}</td>
                            <td>{{ $message->phone ?? '-' }}</td>
                            <td>
                                @if ($message->is_read)
                                    <span class="badge bg-secondary">مقروءة</span>
                                @else
                                    <span class="badge bg-success">جديدة</span>
                                @endif
                            </td>
                            <td>{{ $message->created_at->format('Y-m-d H:i') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.contact-messages.show', $message) }}" class="btn btn-sm btn-outline-primary">عرض</a>
                                @can('delete-contact-messages')
                                    <form action="{{ route('admin.contact-messages.destroy', $message) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('هل تريد حذف الرسالة؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">حذف</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">لا توجد رسائل حالياً.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $messages->withQueryString()->links() }}
    </div>
@endsection
