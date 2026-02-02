@extends('site.layouts.app', [
    'title' => 'اتصل بنا - جمعية السلام',
    'description' => 'نستقبل استفساراتك ومقترحاتك. تواصل معنا عبر النموذج أو معلومات الاتصال المباشرة.'
])

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1><i class="bi bi-chat-left-dots"></i> تواصل معنا</h1>
            <p>نستقبل استفساراتكم ومقترحاتكم بكل اهتمام. فريقنا جاهز للرد عليكم خلال ساعات العمل.</p>
        </div>
    </section>

    <section class="section-block">
        <div class="container">
            <div class="content-card content-card--split">
                <div class="content-main reveal-left">
                    <form action="{{ route('site.contact.store') }}" method="POST" class="form-stack" id="contactForm">
                        @csrf
                        <fieldset>
                            <legend><strong>بيانات التواصل</strong></legend>

                            <div class="row">
                                <div class="col-md-6 mb-3 reveal-up delay-1">
                                    <label class="form-label" for="senderName">
                                        <i class="bi bi-person"></i> الاسم الكامل
                                        <span class="required">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        id="senderName" 
                                        name="name" 
                                        class="form-control" 
                                        value="{{ old('name') }}" 
                                        required
                                        aria-describedby="nameHelp">
                                </div>
                                <div class="col-md-6 mb-3 reveal-up delay-2">
                                    <label class="form-label" for="senderEmail">
                                        <i class="bi bi-envelope"></i> البريد الإلكتروني
                                        <span class="required">*</span>
                                    </label>
                                    <input 
                                        type="email" 
                                        id="senderEmail" 
                                        name="email" 
                                        class="form-control" 
                                        value="{{ old('email') }}"
                                        required
                                        aria-describedby="emailHelp">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3 reveal-up delay-3">
                                    <label class="form-label" for="senderPhone">
                                        <i class="bi bi-telephone"></i> رقم الهاتف
                                    </label>
                                    <input 
                                        type="tel" 
                                        id="senderPhone" 
                                        name="phone" 
                                        class="form-control" 
                                        value="{{ old('phone') }}"
                                        placeholder="+966 50 0000000"
                                        aria-describedby="phoneHelp">
                                </div>
                                <div class="col-md-6 mb-3 reveal-up delay-4">
                                    <label class="form-label" for="messageSubject">
                                        <i class="bi bi-chat-square-quote"></i> موضوع الرسالة
                                        <span class="required">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        id="messageSubject" 
                                        name="subject" 
                                        class="form-control" 
                                        value="{{ old('subject') }}"
                                        required
                                        aria-describedby="subjectHelp">
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend><strong>محتوى الرسالة</strong></legend>

                            <div class="mb-3">
                                <label class="form-label" for="messageContent">
                                    <i class="bi bi-pencil-square"></i> الرسالة
                                    <span class="required">*</span>
                                </label>
                                <textarea 
                                    id="messageContent" 
                                    name="message" 
                                    class="form-control" 
                                    rows="6"
                                    required
                                    placeholder="اكتب رسالتك هنا..."
                                    aria-describedby="messageHelp">{{ old('message') }}</textarea>
                                <small id="messageHelp" class="form-text">يرجى التفصيل قدر الإمكان حتى نتمكن من مساعدتك بشكل أفضل</small>
                            </div>
                        </fieldset>

                        <div class="form-actions reveal-up delay-5">
                            <button type="submit" class="site-cta site-cta--large">
                                <i class="bi bi-send"></i> إرسال الرسالة
                            </button>
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-clockwise"></i> مسح البيانات
                            </button>
                        </div>
                    </form>
                </div>

                <div class="content-side reveal-right">
                    <div class="sidebar-card sidebar-card--primary reveal-zoom delay-1">
                        <h4><i class="bi bi-telephone-outbound"></i> بيانات التواصل المباشرة</h4>
                        <ul class="contact-info">
                            <li class="reveal-up delay-2">
                                <i class="bi bi-telephone-fill"></i>
                                <a href="tel:{{ str_replace([' ', '-'], '', $about->phone ?? '') }}">
                                    {{ $about->phone ?? 'سيتم إضافة الرقم قريبًا' }}
                                </a>
                            </li>
                            <li class="reveal-up delay-3">
                                <i class="bi bi-envelope-fill"></i>
                                <a href="mailto:{{ $about->email ?? 'info@example.com' }}">
                                    {{ $about->email ?? 'info@example.com' }}
                                </a>
                            </li>
                            <li class="reveal-up delay-4">
                                <i class="bi bi-geo-alt-fill"></i>
                                <span>{{ $about->address ?? 'سيتم إضافة العنوان قريبًا' }}</span>
                            </li>
                        </ul>
                    </div>

                    <div class="sidebar-card sidebar-card--secondary">
                        <h4><i class="bi bi-clock-history"></i> أوقات العمل</h4>
                        <ul class="working-hours">
                            <li>
                                <strong>أيام الأسبوع:</strong><br>
                                من 9:00 صباحًا إلى 5:00 مساءً
                            </li>
                            <li>
                                <strong>يوم الجمعة والسبت:</strong><br>
                                مغلق
                            </li>
                        </ul>
                        <p class="contact-note">
                            <i class="bi bi-info-circle"></i> 
                            سنرد على رسالتك في أقرب وقت ممكن خلال ساعات العمل الرسمية.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
