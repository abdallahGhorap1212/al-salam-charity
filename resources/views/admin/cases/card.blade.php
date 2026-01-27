<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>كارت مستفيد</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            background: #f6f5f2;
            padding: 24px;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
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
        .print-actions {
            margin-bottom: 16px;
        }
        .print-actions button {
            border: 0;
            background: #0f5b5f;
            color: #fff;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
        }
        @media print {
            body {
                background: #fff;
                padding: 0;
                margin: 0;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .print-actions {
                display: none;
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
    <div class="print-actions">
        <button onclick="window.print()">طباعة الكارت</button>
    </div>
    @php
        $areaKey = $case->area?->name ?: 'default';
        $palette = ['#0f5b5f', '#c4632b', '#0b4f6c', '#7b3f74', '#2b7a4b', '#b03a2e'];
        $areaIndex = abs(crc32($areaKey)) % count($palette);
        $areaColor = $palette[$areaIndex];
    @endphp
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
</body>
</html>
