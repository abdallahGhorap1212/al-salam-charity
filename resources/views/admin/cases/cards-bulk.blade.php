<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>طباعة البطاقات</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            background: #f6f5f2;
            padding: 24px;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .print-toolbar {
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            background: white;
            padding: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .print-toolbar button {
            border: 0;
            background: #0f5b5f;
            color: #fff;
            padding: 10px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
        }
        .print-toolbar button:hover {
            background: #0d4a4e;
        }
        .print-toolbar span {
            color: #666;
            font-size: 14px;
        }
        .content {
            margin-top: 80px;
        }
        .card-page {
            margin-bottom: 20px;
        }
        .card {
            width: 86mm;
            height: 54mm;
            border-radius: 14px;
            background: #fff;
            border: 1px solid #e3e7e6;
            border-top: 6px solid var(--area-color);
            padding: 12px;
            box-sizing: border-box;
            position: relative;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        .card-top {
            display: none;
        }
        .card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            padding-bottom: 6px;
            margin-bottom: 6px;
        }
        .logo {
            width: 36px;
            height: 36px;
            object-fit: contain;
            background: rgba(0, 0, 0, 0.04);
            border-radius: 10px;
            padding: 4px;
        }
        .title {
            font-size: 12px;
            font-weight: 700;
        }
        .subtitle {
            font-size: 10px;
            color: #555;
        }
        .fields-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4px 10px;
        }
        .field {
            font-size: 10px;
        }
        .label {
            color: #777;
            font-size: 9px;
        }
        .barcode {
            margin-top: 6px;
            text-align: center;
            padding: 6px 8px;
            border-radius: 10px;
            background: rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }
        .barcode img {
            width: 200px;
            height: 32px;
            display: block;
            margin: 0 auto;
        }
        .back-card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border: 1px solid rgba(0, 0, 0, 0.06);
        }
        .rules {
            font-size: 10px;
            color: #555;
            line-height: 1.6;
            margin-top: 6px;
        }
        .contact {
            background: rgba(0, 0, 0, 0.04);
            border-radius: 10px;
            padding: 8px;
            font-size: 11px;
        }
        @media print {
            body {
                background: #fff;
                padding: 0;
                margin: 0;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .print-toolbar {
                display: none;
            }
            .content {
                margin-top: 0;
            }
            .card-page {
                page-break-after: always;
                margin: 0;
                width: 86mm;
                height: 54mm;
            }
            .card-page:last-child {
                page-break-after: auto;
            }
            @page {
                size: 86mm 54mm;
                margin: 0;
            }
        }
    </style>
</head>
<body>
    <div class="print-toolbar">
        <button onclick="window.print()">🖨️ طباعة البطاقات</button>
        <span>إجمالي البطاقات: {{ count($casesData) * 2 }} صفحة</span>
    </div>

    <div class="content">
        @forelse ($casesData as $item)
            @php
                $case = $item['case'];
                $barcodeUrl = $item['barcodeUrl'];
                $areaKey = $case->area?->name ?: 'default';
                $palette = ['#0f5b5f', '#c4632b', '#0b4f6c', '#7b3f74', '#2b7a4b', '#b03a2e'];
                $areaIndex = abs(crc32($areaKey)) % count($palette);
                $areaColor = $palette[$areaIndex];
            @endphp
            <!-- Front side -->
            <div class="card-page">
                <div class="card" style="--area-color: {{ $areaColor }};">
                    <div class="card-top"></div>
                    <div class="card-header">
                        <img src="{{ asset('images/logo-transparent.png') }}" alt="جمعية السلام" class="logo">
                        <div>
                            <div class="title">جمعية السلام الخيرية</div>
                            <div class="subtitle">كارت مستفيد - {{ $case->area?->name }}</div>
                        </div>
                    </div>

                    <div class="fields-grid">
                        <div class="field">
                            <div class="label">الاسم</div>
                            <div>{{ $case->name }}</div>
                        </div>
                        <div class="field">
                            <div class="label">رقم الحالة</div>
                            <div>{{ $case->case_number }}</div>
                        </div>
                        <div class="field">
                            <div class="label">المنطقة</div>
                            <div>{{ $case->area?->name }}</div>
                        </div>
                        <div class="field">
                            <div class="label">نوع الحالة</div>
                            <div>{{ $case->caseType?->name }}</div>
                        </div>
                    </div>

                    <div class="barcode">
                        @if (!empty($barcodeUrl))
                            <img src="{{ $barcodeUrl }}" alt="barcode">
                        @else
                            <div class="label">تعذر إنشاء الباركود</div>
                        @endif
                        <div class="label">{{ $case->barcode }}</div>
                    </div>
                </div>
            </div>

            <!-- Back side -->
            <div class="card-page">
                <div class="card back-card" style="--area-color: {{ $areaColor }};">
                    <div class="card-top"></div>
                    <div>
                        <div class="title">تعليمات استخدام الكارت</div>
                        <div class="rules">
                            - يستخدم هذا الكارت لاستلام المساعدات فقط.<br>
                            - لا يسمح بالصرف إلا لصاحب الكارت.<br>
                            - في حالة الفقدان يرجى التواصل مع الإدارة فورًا.
                        </div>
                    </div>
                    <div class="contact">
                        هاتف الجمعية: 0100-000-0000<br>
                        العنوان: مقر جمعية السلام الخيرية
                    </div>
                </div>
            </div>
        @empty
            <div style="text-align: center; padding: 40px; color: #999;">
                لا توجد حالات للطباعة
            </div>
        @endforelse
    </div>
</body>
</html>
