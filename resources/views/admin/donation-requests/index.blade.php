@extends('admin.layouts.app')

@section('title', 'طلبات التبرع')

@section('content')
    <div class="text-muted mb-3">إجمالي النتائج: {{ $requests->total() }}</div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>المتبرع</th>
                        <th>الخدمة</th>
                        <th>المبلغ</th>
                        <th>الحالة</th>
                        <th>التاريخ</th>
                        <th class="text-end">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($requests as $donationRequest)
                        <tr>
                            <td>{{ $donationRequest->name }}</td>
                            <td>{{ $donationRequest->service->title ?? 'تبرع عام' }}</td>
                            <td>{{ $donationRequest->amount ? number_format($donationRequest->amount, 2) : '-' }}</td>
                            <td>{{ $donationRequest->status }}</td>
                            <td>{{ $donationRequest->created_at->format('Y-m-d H:i') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.donation-requests.show', $donationRequest) }}" class="btn btn-sm btn-outline-secondary">عرض</a>
                                @can('edit-donation-requests')
                                    <a href="{{ route('admin.donation-requests.edit', $donationRequest) }}" class="btn btn-sm btn-outline-primary">تعديل الحالة</a>
                                @endcan
                                @can('delete-donation-requests')
                                    <form action="{{ route('admin.donation-requests.destroy', $donationRequest) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('هل تريد حذف الطلب؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">حذف</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">لا توجد طلبات حالياً.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $requests->withQueryString()->links() }}
    </div>
@endsection
