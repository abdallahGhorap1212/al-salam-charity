# Al Salam Charity System

A comprehensive platform for managing a charity organization, including an admin dashboard and a public website.

## Key Features
- Full admin dashboard for managing cases, areas, case types, users, roles, and permissions.
- **Organized sidebar with categories** - Dashboard menu is grouped into 5 sections for better organization:
  - Case Management (Case Types, Areas, Cases, Aid Distribution)
  - Content Management (News, Services, About, Board Members)
  - Interactions (Contact Messages, Donation Requests)
  - System Management (Users, Roles, Permissions)
- News management with WYSIWYG editor, cover image, and in-article gallery.
- Services management with cover images.
- Board members management with photos.
- Contact us page (messages stored in database).
- Donations page (donation request without payment gateway for now).
- **Bulk card printing** - Print all beneficiary cards at once (with front and back) from one button.
- Public website pages: Home, Services, News, About, Contact, Donations.

## Tech Stack
- Laravel 12
- PHP 8.2+
- MySQL
- Bootstrap 5
- Bootstrap Icons (for UI icons)
- Vite + Sass

## Architecture (Repository / Service / FormRequest)
- `app/Repositories` for data access
- `app/Services` for business logic
- `app/Http/Requests` for validation
- Controllers are thin and use services

## Requirements
- PHP 8.2+
- Composer
- Node.js + npm
- MySQL

## Local Setup
1) Copy environment file:
```
cp .env.example .env
```
2) Configure database in `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=charity_system
DB_USERNAME=
DB_PASSWORD=
```
3) Install dependencies:
```
composer install
npm install
```
4) Generate key and migrate:
```
php artisan key:generate
php artisan migrate
```
5) Storage link:
```
php artisan storage:link
```
6) Run the app:
```
php artisan serve
npm run dev
```

## Default Admin Account
If you run:
```
php artisan db:seed --class=RolePermissionSeeder
```
It creates:
- Email: `admin@charity.com`
- Password: `password`

## Features Usage

### Bulk Card Printing
1. Navigate to Cases Management → Cases
2. Click "طباعة جميع البطاقات" (Print All Cards) button
3. A new page opens with all beneficiary cards (front and back)
4. Click the print button (🖨️) to customize print settings and print
5. Each card includes:
   - Front: Beneficiary name, case number, area, case type, and barcode
   - Back: Usage instructions and contact information

### Sidebar Organization
The admin sidebar is now organized into 5 main sections with icons:
- 🏠 Dashboard
- 📋 Case Management
- 📰 Content Management
- 💬 Interactions
- ⚙️ System Management

## Useful Commands
- Export cases:
```
php artisan admin:cases-export
```
- Export distributions (Excel / PDF):
```
/admin/distributions-export
/admin/distributions-export-pdf
```
- Print all cards:
```
/admin/cases-print-all
```

## Important Paths
- `app/Http/Controllers` - Controllers
- `app/Services` - Business Logic
- `app/Repositories` - Data Access
- `resources/views` - Blade Templates
- `resources/views/admin/cases/cards-bulk.blade.php` - Bulk card printing page
- `resources/sass` - SCSS Styles

## Notes
- All images are uploaded via the dashboard and stored in `storage/app/public`.
- News page uses pagination.
- Barcode images are generated automatically in `storage/app/public/barcodes/`.
- Storage symlink is required for barcode images to display correctly.

---

# نظام جمعية السلام الخيرية

منصة متكاملة لإدارة جمعية خيرية تشمل لوحة تحكم للإدارة وموقع عام للجمهور.

## أهم المزايا
- لوحة إدارة كاملة لإدارة الحالات، المناطق، أنواع الحالات، المستخدمين، الأدوار والصلاحيات.
- **شريط قوائم منظم بأقسام** - قائمة الإدارة مقسمة إلى 5 أقسام منظمة:
  - إدارة الحالات (أنواع الحالات، المناطق، الحالات، الصرف)
  - إدارة المحتوى (الأخبار، الخدمات، نبذة عن الجمعية، مجلس الإدارة)
  - التفاعلات (رسائل التواصل، طلبات التبرع)
  - إدارة النظام (المستخدمين، الأدوار، الصلاحيات)
- إدارة الأخبار مع محرر WYSIWYG وصور غلاف ومعرض صور داخل الخبر.
- إدارة الخدمات مع صور غلاف لكل خدمة.
- إدارة أعضاء مجلس الإدارة بالصور.
- صفحة تواصل معنا وتسجيل الرسائل في قاعدة البيانات.
- صفحة التبرعات (طلب تبرع بدون بوابة دفع حالياً).
- **طباعة البطاقات الجماعية** - طباعة جميع بطاقات المستفيدين دفعة واحدة (وجه وظهر) من زر واحد.
- موقع عام حديث مع صفحات: الرئيسية، الخدمات، الأخبار، نبذة عن الجمعية، تواصل معنا، التبرعات.

## التقنية المستخدمة
- Laravel 12
- PHP 8.2+
- MySQL
- Bootstrap 5
- Bootstrap Icons (لأيقونات الواجهة)
- Vite + Sass

## هيكلة الكود (Repository / Service / FormRequest)
- `app/Repositories` لجميع الاستعلامات
- `app/Services` لمنطق الأعمال
- `app/Http/Requests` للتحقق من البيانات
- Controllers أصبحت خفيفة وتعتمد على الـ Services

## المتطلبات
- PHP 8.2+
- Composer
- Node.js + npm
- MySQL

## التشغيل محلياً
1) نسخ ملف البيئة:
```
cp .env.example .env
```
2) إعداد قاعدة البيانات في `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=charity_system
DB_USERNAME=
DB_PASSWORD=
```
3) تثبيت الباكجات:
```
composer install
npm install
```
4) توليد المفتاح وتشغيل الميجريشن:
```
php artisan key:generate
php artisan migrate
```
5) إنشاء رابط التخزين:
```
php artisan storage:link
```
6) تشغيل السيرفر:
```
php artisan serve
npm run dev
```

## حساب المدير الافتراضي
إذا شغّلت Seeder الصلاحيات:
```
php artisan db:seed --class=RolePermissionSeeder
```
سيتم إنشاء مستخدم:
- Email: `admin@charity.com`
- Password: `password`

## استخدام المزايا

### طباعة البطاقات الجماعية
1. انتقل إلى إدارة الحالات → الحالات
2. اضغط على زر "طباعة جميع البطاقات"
3. تفتح صفحة جديدة تحتوي على جميع بطاقات المستفيدين (وجه وظهر)
4. اضغط على زر الطباعة (🖨️) لتخصيص إعدادات الطباعة والطباعة
5. كل بطاقة تتضمن:
   - الوجه: اسم المستفيد، رقم الحالة، المنطقة، نوع الحالة، والباركود
   - الظهر: تعليمات الاستخدام وبيانات التواصل

### تنظيم الشريط الجانبي
الشريط الجانبي للإدارة الآن منظم إلى 5 أقسام رئيسية مع أيقونات:
- 🏠 لوحة التحكم
- 📋 إدارة الحالات
- 📰 إدارة المحتوى
- 💬 التفاعلات
- ⚙️ إدارة النظام

## أوامر مفيدة
- تصدير الحالات:
```
php artisan admin:cases-export
```
- تصدير الصرف (Excel / PDF):
```
/admin/distributions-export
/admin/distributions-export-pdf
```
- طباعة جميع البطاقات:
```
/admin/cases-print-all
```

## المجلدات المهمة
- `app/Http/Controllers` - الكنترولرز
- `app/Services` - منطق الأعمال
- `app/Repositories` - الاستعلامات
- `resources/views` - واجهات Blade
- `resources/views/admin/cases/cards-bulk.blade.php` - صفحة طباعة البطاقات الجماعية
- `resources/sass` - ملفات التصميم

## ملاحظات
- كل الصور تُرفع عبر لوحة الإدارة وتُحفظ داخل `storage/app/public`.
- صفحة الأخبار تعرض أحدث الأخبار، وصفحة الأخبار العامة تستخدم Pagination.
- صور الباركود يتم توليدها تلقائياً داخل `storage/app/public/barcodes/`.
- رابط التخزين مهم جداً لعرض صور الباركود بشكل صحيح.

---
**Al Salam Charity System / نظام جمعية السلام الخيرية**
