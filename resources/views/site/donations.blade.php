@extends('site.layouts.app', [
    'title' => 'التبرعات - جمعية السلام',
    'description' => 'ساهم معنا في دعم المشاريع الخيرية. قدم تبرعك لمختلف الخدمات الاجتماعية والصحية والتعليمية.'
])

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1><i class="bi bi-hand-thumbs-up"></i> التبرعات والمساهمات</h1>
            <p>تبرعك يصنع فرقًا حقيقيًا في حياة الأسر المحتاجة. اختر طريقة مساهمتك معنا.</p>
        </div>
    </section>

    <section class="section-block">
        <div class="container">
            <!-- Donation Types Info -->
            <div class="donation-types-grid mb-5" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem;">
                <div class="donation-type-card donation-type-card--primary" style="animation: slideInUp 0.6s ease-out;">
                    <div class="icon"><i class="bi bi-gift-heart"></i></div>
                    <h3>تبرع عام</h3>
                    <p>ساهم بمبلغ من اختيارك لدعم كل مشاريعنا.</p>
                    <span class="badge bg-success">الأكثر اختياراً</span>
                </div>
                <div class="donation-type-card donation-type-card--secondary" style="animation: slideInUp 0.6s ease-out 0.1s backwards;">
                    <div class="icon"><i class="bi bi-heart-fill"></i></div>
                    <h3>تبرع موجه</h3>
                    <p>اختر خدمة معينة وساهم في دعمها مباشرة.</p>
                    <span class="badge bg-info">تأثير مباشر</span>
                </div>
                <div class="donation-type-card donation-type-card--accent" style="animation: slideInUp 0.6s ease-out 0.2s backwards;">
                    <div class="icon"><i class="bi bi-calendar2-check"></i></div>
                    <h3>تبرع دوري</h3>
                    <p>تبرع شهري منتظم لضمان استدامة برامجنا.</p>
                    <span class="badge bg-warning">مستدام</span>
                </div>
            </div>

            <div class="content-card" style="display: grid; grid-template-columns: 1fr 350px; gap: 3rem; align-items: start;">
                <div class="content-main" style="animation: slideInLeft 0.6s ease-out;">
                    <form action="{{ route('site.donations.store') }}" method="POST" class="form-stack" id="donationForm">
                        @csrf
                        <fieldset>
                            <legend><strong>بيانات المتبرع</strong></legend>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="donorName">
                                        <i class="bi bi-person"></i> الاسم الكامل
                                        <span class="required">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        id="donorName" 
                                        name="name" 
                                        class="form-control" 
                                        value="{{ old('name') }}" 
                                        required
                                        aria-describedby="nameHelp">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="donorEmail">
                                        <i class="bi bi-envelope"></i> البريد الإلكتروني
                                    </label>
                                    <input 
                                        type="email" 
                                        id="donorEmail" 
                                        name="email" 
                                        class="form-control" 
                                        value="{{ old('email') }}"
                                        aria-describedby="emailHelp">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="donorPhone">
                                        <i class="bi bi-telephone"></i> رقم الهاتف
                                    </label>
                                    <input 
                                        type="tel" 
                                        id="donorPhone" 
                                        name="phone" 
                                        class="form-control" 
                                        value="{{ old('phone') }}"
                                        placeholder="+966 50 0000000"
                                        aria-describedby="phoneHelp">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="donationAmount">
                                        <i class="bi bi-cash-coin"></i> مبلغ التبرع (اختياري)
                                    </label>
                                    <div class="input-group">
                                        <input 
                                            type="number" 
                                            id="donationAmount" 
                                            name="amount" 
                                            min="1" 
                                            step="0.01" 
                                            class="form-control" 
                                            value="{{ old('amount') }}"
                                            placeholder="0.00"
                                            aria-describedby="amountHelp">
                                        <span class="input-group-text">ج.م</span>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend><strong>تفاصيل التبرع</strong></legend>
                            
                            <div class="mb-3">
                                <label class="form-label" for="donationService">
                                    <i class="bi bi-bookmark"></i> تحديد خدمة (اختياري)
                                </label>
                                <select id="donationService" name="service_id" class="form-select" aria-describedby="serviceHelp">
                                    <option value="">-- تبرع عام (لكل المشاريع) --</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}" @selected(old('service_id') == $service->id)>
                                            {{ $service->title }}
                                        </option>
                                    @endforeach
                                </select>
                                <small id="serviceHelp" class="form-text">اختر خدمة معينة أو اترك الخيار الأول للتبرع العام</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="donationNotes">
                                    <i class="bi bi-chat-left-text"></i> ملاحظات إضافية
                                </label>
                                <textarea 
                                    id="donationNotes" 
                                    name="notes" 
                                    class="form-control" 
                                    rows="4"
                                    placeholder="أخبرنا برغبتك أو ملاحظاتك..."
                                    aria-describedby="notesHelp">{{ old('notes') }}</textarea>
                                <small id="notesHelp" class="form-text">يمكنك إضافة أي ملاحظات أو طلبات خاصة</small>
                            </div>

                            <div class="form-check mb-3">
                                <input 
                                    type="checkbox" 
                                    class="form-check-input" 
                                    id="agreeTerms" 
                                    required>
                                <label class="form-check-label" for="agreeTerms">
                                    أوافق على <a href="{{ route('site.terms-and-conditions') }}" target="_blank">الشروط والأحكام</a>
                                </label>
                            </div>
                        </fieldset>

                        <div class="form-actions">
                            <button type="submit" class="site-cta site-cta--large">
                                <i class="bi bi-check-circle"></i> إرسال طلب التبرع
                            </button>
                            <p class="form-note">
                                <i class="bi bi-info-circle"></i> 
                                هذه الصفحة لاستقبال طلبات التبرع. سيتم التواصل معك في أقرب وقت لإتمام العملية بسهولة.
                            </p>
                        </div>
                    </form>
                </div>

                <div class="content-side" style="animation: slideInRight 0.6s ease-out;">
                    <div class="sidebar-card sidebar-card--primary" style="animation: zoomIn 0.6s ease-out 0.2s backwards;">
                        <h4><i class="bi bi-question-circle"></i> أسئلة شائعة</h4>
                        <div class="faq-section">
                            <div class="faq-item" style="animation: fadeInUp 0.6s ease-out 0.3s backwards;">
                                <strong>هل تبرعي آمن؟</strong>
                                <p>نعم، نتبع أعلى معايير الأمان والشفافية في التعامل مع التبرعات.</p>
                            </div>
                            <div class="faq-item" style="animation: fadeInUp 0.6s ease-out 0.4s backwards;">
                                <strong>كيف سأتابع تبرعي؟</strong>
                                <p>سنرسل لك تقارير دورية عن استخدام تبرعك والأثر الذي أحدثه.</p>
                            </div>
                            <div class="faq-item" style="animation: fadeInUp 0.6s ease-out 0.5s backwards;">
                                <strong>هل يمكنني تبرع دوري؟</strong>
                                <p>نعم، يمكنك التبرع بشكل دوري منتظم. تواصل معنا للترتيبات اللازمة.</p>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-card sidebar-card--secondary" style="animation: zoomIn 0.6s ease-out 0.3s backwards;">
                        <h4><i class="bi bi-telephone-outbound"></i> تواصل معنا مباشرة</h4>
                        <ul class="contact-info">
                            <li style="animation: fadeInUp 0.6s ease-out 0.4s backwards;">
                                <i class="bi bi-telephone"></i> 
                                <strong>الهاتف:</strong><br>
                                <a href="tel:{{ str_replace([' ', '-'], '', $about->phone ?? '') }}">
                                    {{ $about->phone ?? 'سيتم إضافة الرقم قريبًا' }}
                                </a>
                            </li>
                            <li style="animation: fadeInUp 0.6s ease-out 0.5s backwards;">
                                <i class="bi bi-envelope"></i> 
                                <strong>البريد:</strong><br>
                                <a href="mailto:{{ $about->email ?? 'info@example.com' }}">
                                    {{ $about->email ?? 'info@example.com' }}
                                </a>
                            </li>
                            <li style="animation: fadeInUp 0.6s ease-out 0.6s backwards;">
                                <i class="bi bi-geo-alt"></i> 
                                <strong>العنوان:</strong><br>
                                {{ $about->address ?? 'سيتم إضافة العنوان قريبًا' }}
                            </li>
                        </ul>
                        <div class="contact-note">
                            <p>فريقنا جاهز للإجابة على جميع استفساراتك خلال ساعات العمل.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
