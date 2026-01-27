# Al Salam Charity System

A comprehensive platform for managing a charity organization, including an admin dashboard and a public website.

## Key Features
- Full admin dashboard for managing cases, areas, case types, users, roles, and permissions.
- News management with WYSIWYG editor, cover image, and in-article gallery.
- Services management with cover images.
- Board members management with photos.
- Contact us page (messages stored in database).
- Donations page (donation request without payment gateway for now).
- Public website pages: Home, Services, News, About, Contact, Donations.

## Tech Stack
- Laravel 12
- PHP 8.2+
- MySQL
- Bootstrap 5
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
DB_USERNAME=root
DB_PASSWORD=1234
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

## Important Paths
- `app/Http/Controllers`
- `app/Services`
- `app/Repositories`
- `resources/views`
- `resources/sass`

## Notes
- All images are uploaded via the dashboard and stored in `storage/app/public`.
- News page uses pagination.

---

# نظام جمعية السلام الخيرية

منصة متكاملة لإدارة جمعية خيرية تشمل لوحة تحكم للإدارة وموقع عام للجمهور.

## أهم المزايا
- لوحة إدارة كاملة لإدارة الحالات، المناطق، أنواع الحالات، المستخدمين، الأدوار والصلاحيات.
- إدارة الأخبار مع محرر WYSIWYG وصور غلاف ومعرض صور داخل الخبر.
- إدارة الخدمات مع صور غلاف لكل خدمة.
- إدارة أعضاء مجلس الإدارة بالصور.
- صفحة تواصل معنا وتسجيل الرسائل في قاعدة البيانات.
- صفحة التبرعات (طلب تبرع بدون بوابة دفع حالياً).
- موقع عام حديث مع صفحات: الرئيسية، الخدمات، الأخبار، نبذة عن الجمعية، تواصل معنا، التبرعات.

## التقنية المستخدمة
- Laravel 12
- PHP 8.2+
- MySQL
- Bootstrap 5
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
DB_USERNAME=root
DB_PASSWORD=1234
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

## المجلدات المهمة
- `app/Http/Controllers` الكنترولرز
- `app/Services` منطق الأعمال
- `app/Repositories` الاستعلامات
- `resources/views` واجهات Blade
- `resources/sass` ملفات التصميم

## ملاحظات
- كل الصور تُرفع عبر لوحة الإدارة وتُحفظ داخل `storage/app/public`.
- صفحة الأخبار تعرض أحدث الأخبار، وصفحة الأخبار العامة تستخدم Pagination.

---
**Al Salam Charity System / نظام جمعية السلام الخيرية**
