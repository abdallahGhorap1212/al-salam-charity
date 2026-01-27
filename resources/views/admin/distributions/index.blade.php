@extends('admin.layouts.app')

@section('title', 'سجل الصرف')

@section('content')
    <div class="row g-3 align-items-center mb-3">
        <div class="col-lg-5">
            <form method="GET" action="{{ route('admin.distributions.index') }}" class="d-flex gap-2 flex-wrap">
                <input type="date" name="from" class="form-control" value="{{ request('from') }}">
                <input type="date" name="to" class="form-control" value="{{ request('to') }}">
                <button class="btn btn-outline-secondary" type="submit">تصفية</button>
                <a href="{{ route('admin.distributions.index') }}" class="btn btn-outline-light">مسح</a>
            </form>
        </div>
        <div class="col-lg-7 d-flex justify-content-lg-end flex-wrap gap-2">
            <a href="{{ route('admin.distributions.create') }}" class="btn btn-primary">تسجيل استلام جديد</a>
            <a href="{{ route('admin.distributions.export') }}" class="btn btn-outline-success">تصدير Excel</a>
            <a href="{{ route('admin.distributions.export-pdf') }}" class="btn btn-outline-dark">تصدير PDF</a>
        </div>
        <div class="col-12 text-muted">إجمالي النتائج: {{ $distributions->total() }}</div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>الحالة</th>
                        <th>نوع المصروف</th>
                        <th>المبلغ</th>
                        <th>المستخدم</th>
                        <th>تاريخ الصرف</th>
                        <th>ملاحظات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($distributions as $distribution)
                        <tr>
                            <td>
                                <a href="{{ route('admin.cases.show', $distribution->case) }}" class="text-decoration-none">
                                    <strong>{{ $distribution->case?->name }}</strong>
                                </a>
                                <br>
                                <small class="text-muted">{{ $distribution->case?->case_number }}</small>
                            </td>
                            <td>
                                @if ($distribution->type)
                                    <span class="badge bg-{{ $distribution->type->color }}">
                                        {{ $distribution->type->ar_name }}
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if ($distribution->amount)
                                    <strong class="text-success">{{ number_format($distribution->amount, 2) }} {{ $distribution->currency }}</strong>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $distribution->user?->name }}</td>
                            <td>
                                {{ optional($distribution->distribution_date)->format('Y-m-d H:i') }}
                                <br>
                                <small class="text-muted">{{ optional($distribution->distribution_date)->diffForHumans() }}</small>
                            </td>
                            <td>
                                @if ($distribution->notes)
                                    <span class="text-muted">{{ Str::limit($distribution->notes, 40) }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">لا توجد عمليات صرف.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $distributions->withQueryString()->links() }}
    </div>
@endsection
