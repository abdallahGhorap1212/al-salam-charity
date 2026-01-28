<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Settings بتاع الألوان
        SiteSetting::set('primary_color', '#1779BA', 'اللون الأساسي للموقع', 'color', 'colors');
        SiteSetting::set('secondary_color', '#198754', 'اللون الثانوي', 'color', 'colors');
        SiteSetting::set('accent_color', '#FF6B35', 'اللون المميز', 'color', 'colors');
        SiteSetting::set('dark_color', '#1B2631', 'اللون الداكن', 'color', 'colors');

        // Settings بتاع وسائل التواصل الاجتماعي
        SiteSetting::set('facebook_url', 'https://facebook.com', 'رابط صفحة الفيسبوك', 'url', 'social');
        SiteSetting::set('twitter_url', 'https://twitter.com', 'رابط صفحة التويتر', 'url', 'social');
        SiteSetting::set('instagram_url', 'https://instagram.com', 'رابط صفحة الإنستجرام', 'url', 'social');
        SiteSetting::set('linkedin_url', 'https://linkedin.com', 'رابط صفحة لينكدإن', 'url', 'social');
        SiteSetting::set('youtube_url', 'https://youtube.com', 'رابط قناة اليوتيوب', 'url', 'social');
        SiteSetting::set('whatsapp_number', '+966501234567', 'رقم الواتس آب', 'phone', 'social');

        // Settings بتاع معلومات الجمعية
        SiteSetting::set('organization_name', 'جمعية السلام', 'اسم المؤسسة', 'text', 'general');
        SiteSetting::set('organization_email', 'info@al-salam.org', 'البريد الإلكتروني للمؤسسة', 'email', 'general');
        SiteSetting::set('organization_phone', '+966501234567', 'رقم هاتف المؤسسة', 'phone', 'general');
        SiteSetting::set('organization_address', 'الرياض، المملكة العربية السعودية', 'عنوان المؤسسة', 'text', 'general');
        SiteSetting::set('organization_description', 'مؤسسة خيرية متخصصة في تقديم خدمات صحية واجتماعية وتعليمية', 'وصف المؤسسة', 'textarea', 'general');

        // Settings بتاع النصوص الثابتة
        SiteSetting::set('hero_title', 'إيد واحدة تغيّر حياة كاملة', 'عنوان قسم البطل (Hero)', 'text', 'content');
        SiteSetting::set('hero_description', 'نصنع مبادرات تنموية مستدامة ونساند الأسر الأكثر احتياجًا عبر خدمات صحية واجتماعية وتعليمية.', 'وصف قسم البطل', 'textarea', 'content');
        SiteSetting::set('footer_description', 'نخدم المجتمع بمبادرات إنسانية مستدامة وقيم التكافل الاجتماعي.', 'وصف الفوتر', 'textarea', 'content');

        // Settings بتاع الإعدادات العامة
        SiteSetting::set('site_title', 'جمعية السلام', 'عنوان الموقع (SEO)', 'text', 'seo');
        SiteSetting::set('site_description', 'جمعية السلام مؤسسة خيرية متخصصة في تقديم خدمات صحية واجتماعية وتعليمية للأسر المستحقة.', 'وصف الموقع (SEO)', 'textarea', 'seo');
        SiteSetting::set('site_keywords', 'جمعية خيرية, التكافل الاجتماعي, خدمات اجتماعية', 'كلمات مفتاحية (SEO)', 'text', 'seo');
    }
}
