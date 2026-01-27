@extends('site.layouts.app')

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1>التبرعات</h1>
            <p>يمكنك التبرع بشكل عام أو توجيه التبرع لخدمة محددة.</p>
        </div>
    </section>

    <section class="section-block">
        <div class="container">
            <div class="content-card">
                <div class="content-main">
                    <form action="{{ route('site.donations.store') }}" method="POST" class="form-stack">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">الاسم</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">البريد الإلكتروني</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">رقم الهاتف</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">مبلغ التبرع (اختياري)</label>
                                <input type="number" name="amount" min="1" step="0.01" class="form-control" value="{{ old('amount') }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">تحديد خدمة (اختياري)</label>
                            <select name="service_id" class="form-select">
                                <option value="">تبرع عام</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}" @selected(old('service_id') == $service->id)>
                                        {{ $service->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ملاحظات إضافية</label>
                            <textarea name="notes" class="form-control" rows="4">{{ old('notes') }}</textarea>
                        </div>
                        <button type="submit" class="site-cta">إرسال طلب التبرع</button>
                        <p class="form-note">هذه الصفحة لا تحتوي على بوابة دفع بعد، وسيتم التواصل معك لإتمام التبرع.</p>
                    </form>
                </div>
                <div class="content-side">
                    <h4>كيف تتم العملية؟</h4>
                    <ol class="donation-steps">
                        <li>املأ بياناتك واختر نوع التبرع.</li>
                        <li>سيقوم فريق الجمعية بالتواصل معك.</li>
                        <li>ننسق معك طريقة الدفع المناسبة.</li>
                    </ol>
                    <div class="contact-note">
                        <p>الهاتف: {{ $about->phone ?? 'سيتم إضافة رقم الهاتف قريبًا.' }}</p>
                        <p>البريد: {{ $about->email ?? 'info@example.com' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
