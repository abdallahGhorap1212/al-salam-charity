@extends('admin.layouts.app')

@section('title', 'إدارة الأخبار')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="text-muted">إجمالي النتائج: {{ $news->total() }}</div>
        @can('create-news')
            <a href="{{ route('admin.news.create') }}" class="btn btn-primary">إضافة خبر</a>
        @endcan
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>العنوان</th>
                        <th>الحالة</th>
                        <th>تاريخ النشر</th>
                        <th class="text-end">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($news as $item)
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td>
                                @if ($item->is_published)
                                    <span class="badge bg-success">منشور</span>
                                @else
                                    <span class="badge bg-secondary">غير منشور</span>
                                @endif
                            </td>
                            <td>{{ optional($item->published_at)->format('Y-m-d H:i') ?? '-' }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.news.show', $item) }}" class="btn btn-sm btn-outline-secondary">عرض</a>
                                @can('edit-news')
                                    <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-sm btn-outline-primary">تعديل</a>
                                @endcan
                                @can('delete-news')
                                    <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('هل تريد حذف الخبر؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">حذف</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">لا توجد أخبار مسجلة.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $news->withQueryString()->links() }}
    </div>
@endsection
