<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: right; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
    <h3>تقرير الحالات - جمعية السلام</h3>
    <table>
        <thead>
            <tr>
                <th>رقم الحالة</th>
                <th>الاسم</th>
                <th>المنطقة</th>
                <th>نوع الحالة</th>
                <th>عدد الأفراد</th>
                <th>الهاتف</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cases as $case)
                <tr>
                    <td>{{ $case->case_number }}</td>
                    <td>{{ $case->name }}</td>
                    <td>{{ $case->area?->name }}</td>
                    <td>{{ $case->caseType?->name }}</td>
                    <td>{{ $case->family_members_count ?? '-' }}</td>
                    <td>{{ $case->phone }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
