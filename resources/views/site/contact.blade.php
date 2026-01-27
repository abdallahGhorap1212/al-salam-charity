@extends('site.layouts.app')

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1>تواصل معنا</h1>
            <p>نستقبل استفساراتكم ومقترحاتكم على مدار الساعة.</p>
        </div>
    </section>

    <section class="section-block">
        <div class="container">
            <div class="content-card">
                <div class="content-main">
                    <form action="{{ route('site.contact.store') }}" method="POST" class="form-stack">
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
                                <label class="form-label">عنوان الرسالة</label>
                                <input type="text" name="subject" class="form-control" value="{{ old('subject') }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">الرسالة</label>
                            <textarea name="message" class="form-control" rows="5" required>{{ old('message') }}</textarea>
                        </div>
                        <button type="submit" class="site-cta">إرسال الرسالة</button>
                    </form>
                </div>
                <div class="content-side">
                    <h4>بيانات التواصل</h4>
                    <ul class="contact-list">
                        <li>العنوان: {{ $about->address ?? 'سيتم تحديث العنوان قريبًا.' }}</li>
                        <li>الهاتف: {{ $about->phone ?? 'سيتم إضافة رقم الهاتف قريبًا.' }}</li>
                        <li>البريد: {{ $about->email ?? 'info@example.com' }}</li>
                    </ul>
                    <div class="contact-note">
                        <p>نسعد بالتواصل معكم في أي وقت.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
