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
    <h3>تقرير الصرف - جمعية السلام</h3>
    <table>
        <thead>
            <tr>
                <th>الحالة</th>
                <th>المستخدم</th>
                <th>التاريخ</th>
                <th>ملاحظات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($distributions as $distribution)
                <tr>
                    <td>{{ $distribution->case?->name }}</td>
                    <td>{{ $distribution->user?->name }}</td>
                    <td>{{ optional($distribution->distribution_date)->format('Y-m-d H:i') }}</td>
                    <td>{{ $distribution->notes ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
