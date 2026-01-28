# 🎛️ نظام الإعدادات - Settings Management System

## 📋 مقدمة

تم إضافة نظام متكامل للإعدادات يسمح بـ:
- ✅ تغيير الألوان من الـ Dashboard
- ✅ تغيير روابط وسائل التواصل الاجتماعي
- ✅ تغيير معلومات المؤسسة (الاسم، الهاتف، البريد، العنوان)
- ✅ تغيير النصوص الثابتة في الموقع

---

## 🗂️ الملفات الجديدة

### 1. **الموديل (Model)**
- **ملف:** `app/Models/SiteSetting.php`
- **الوظيفة:** تخزين واسترجاع الإعدادات من قاعدة البيانات

### 2. **الـ Migration**
- **ملف:** `database/migrations/2026_01_28_000000_create_site_settings_table.php`
- **الوظيفة:** إنشاء جدول `site_settings` في قاعدة البيانات

### 3. **الـ Seeder**
- **ملف:** `database/seeders/SiteSettingsSeeder.php`
- **الوظيفة:** إضافة الإعدادات الافتراضية

### 4. **Helper Function**
- **ملف:** `app/Support/SettingsHelper.php`
- **الوظيفة:** تسهيل الوصول للإعدادات في الـ Views

### 5. **Controller**
- **ملف:** `app/Http/Controllers/Admin/SettingsController.php`
- **الوظيفة:** التعامل مع تحديث الإعدادات

---

## 🚀 كيفية الاستخدام

### في الـ Controller أو الـ Service:
```php
use App\Support\SettingsHelper;

// الحصول على إعداد معين
$primaryColor = SettingsHelper::get('primary_color', '#1779BA');

// الحصول على جميع الألوان
$colors = SettingsHelper::getColors();

// الحصول على روابط التواصل
$socialLinks = SettingsHelper::getSocialLinks();

// الحصول على معلومات المؤسسة
$organization = SettingsHelper::getOrganization();
```

### في الـ View (Blade):
```blade
{{-- الحصول على إعداد --}}
<div style="color: {{ SettingsHelper::get('primary_color') }}">
    {{ SettingsHelper::get('organization_name') }}
</div>

{{-- الحصول على مجموعة إعدادات --}}
<footer style="background: {{ SettingsHelper::getOrganization()['name'] }}">
    ...
</footer>
```

---

## 📊 الإعدادات المتاحة

### 🎨 الألوان (Colors)
```
- primary_color: اللون الأساسي
- secondary_color: اللون الثانوي
- accent_color: اللون المميز
- dark_color: اللون الداكن
```

### 📱 وسائل التواصل (Social)
```
- facebook_url: رابط الفيسبوك
- twitter_url: رابط التويتر
- instagram_url: رابط الإنستجرام
- linkedin_url: رابط لينكدإن
- youtube_url: رابط اليوتيوب
- whatsapp_number: رقم الواتس آب
```

### 🏢 معلومات المؤسسة (General)
```
- organization_name: اسم المؤسسة
- organization_email: البريد الإلكتروني
- organization_phone: رقم الهاتف
- organization_address: العنوان
- organization_description: الوصف
```

### 📝 المحتوى (Content)
```
- hero_title: عنوان القسم الرئيسي
- hero_description: وصف القسم الرئيسي
- footer_description: وصف الفوتر
```

### 🔎 SEO
```
- site_title: عنوان الموقع
- site_description: وصف الموقع
- site_keywords: الكلمات المفتاحية
```

---

## 🔧 الخطوات التالية

### 1. تشغيل Migration:
```bash
php artisan migrate
```

### 2. تشغيل Seeder:
```bash
php artisan db:seed --class=SiteSettingsSeeder
```

### 3. إضافة Routes:
```php
// في routes/web.php أو routes/admin.php
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/settings', [SettingsController::class, 'index']);
    Route::get('/admin/settings/colors', [SettingsController::class, 'colors']);
    Route::post('/admin/settings/colors', [SettingsController::class, 'updateColors']);
    Route::get('/admin/settings/social', [SettingsController::class, 'social']);
    Route::post('/admin/settings/social', [SettingsController::class, 'updateSocial']);
    Route::get('/admin/settings/organization', [SettingsController::class, 'organization']);
    Route::post('/admin/settings/organization', [SettingsController::class, 'updateOrganization']);
    Route::get('/admin/settings/content', [SettingsController::class, 'content']);
    Route::post('/admin/settings/content', [SettingsController::class, 'updateContent']);
});
```

### 4. إنشاء Views للتعديل:
يجب إنشاء الـ views التالية في `resources/views/admin/settings/`:
- `index.blade.php` - الصفحة الرئيسية
- `colors.blade.php` - تعديل الألوان
- `social.blade.php` - تعديل روابط التواصل
- `organization.blade.php` - تعديل معلومات المؤسسة
- `content.blade.php` - تعديل النصوص

---

## 🔄 تحديث الـ Views

### مثال 1: استخدام اللون الأساسي
```blade
<a href="{{ SettingsHelper::getSocialLinks()['facebook'] }}" 
   style="background: {{ SettingsHelper::getColors()['primary'] }}">
   فيسبوك
</a>
```

### مثال 2: عرض معلومات المؤسسة
```blade
<h1>{{ SettingsHelper::getOrganization()['name'] }}</h1>
<p>{{ SettingsHelper::getOrganization()['description'] }}</p>
<a href="tel:{{ SettingsHelper::getOrganization()['phone'] }}">
    اتصل بنا
</a>
```

---

## ✨ المميزات

✅ **Dynamic Settings** - تغيير الإعدادات بدون تعديل الكود
✅ **Database Stored** - جميع الإعدادات مخزنة في قاعدة البيانات
✅ **Easy Access** - وصول سهل عبر Helper Function
✅ **Type Safe** - أنواع البيانات محددة مسبقاً
✅ **Categorized** - تنظيم الإعدادات حسب الفئات
✅ **Default Values** - قيم افتراضية لكل إعداد
✅ **Admin Dashboard** - واجهة سهلة للتعديل

---

## 📚 أمثلة استخدام متقدمة

### الحصول على إعداد مع قيمة افتراضية:
```php
$email = SettingsHelper::get('organization_email', 'info@example.com');
```

### تحديث إعداد برمجياً:
```php
use App\Models\SiteSetting;

SiteSetting::set('primary_color', '#FF0000', 'اللون الأساسي', 'color', 'colors');
```

### الحصول على جميع الإعدادات مصنفة:
```php
$allSettings = SiteSetting::getAllGrouped();
// النتيجة: ['colors' => [...], 'social' => [...], ...]
```

---

## 🎯 الفوائد

1. **سهولة الصيانة** - تعديل البيانات بدون دخول الكود
2. **المرونة** - إضافة إعدادات جديدة بسهولة
3. **الأمان** - التحقق من صحة البيانات
4. **الأداء** - تخزين مؤقت للإعدادات في الذاكرة
5. **التوسعية** - نظام قابل للتطوير

---

**تم بنجاح! ✅ نظام الإعدادات جاهز للاستخدام!**
