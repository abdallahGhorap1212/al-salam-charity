<?php

namespace App\Support;

use App\Models\SiteSetting;

class SettingsHelper
{
    /**
     * Get a setting value
     */
    public static function get($key, $default = null)
    {
        try {
            return SiteSetting::get($key, $default);
        } catch (\Exception $e) {
            return $default;
        }
    }

    /**
     * Get all colors
     */
    public static function getColors()
    {
        return [
            'primary' => self::get('primary_color', '#1779BA'),
            'secondary' => self::get('secondary_color', '#198754'),
            'accent' => self::get('accent_color', '#FF6B35'),
            'dark' => self::get('dark_color', '#1B2631'),
        ];
    }

    /**
     * Get all social links
     */
    public static function getSocialLinks()
    {
        return [
            'facebook' => self::get('facebook_url', 'https://facebook.com'),
            'twitter' => self::get('twitter_url', 'https://twitter.com'),
            'instagram' => self::get('instagram_url', 'https://instagram.com'),
            'linkedin' => self::get('linkedin_url', 'https://linkedin.com'),
            'youtube' => self::get('youtube_url', 'https://youtube.com'),
            'whatsapp' => self::get('whatsapp_number', '+966501234567'),
        ];
    }

    /**
     * Get organization info
     */
    public static function getOrganization()
    {
        return [
            'name' => self::get('organization_name', 'جمعية السلام'),
            'email' => self::get('organization_email', 'info@al-salam.org'),
            'phone' => self::get('organization_phone', '+966501234567'),
            'address' => self::get('organization_address', 'الرياض'),
            'description' => self::get('organization_description', 'مؤسسة خيرية'),
        ];
    }

    /**
     * Get hero section content
     */
    public static function getHeroContent()
    {
        return [
            'title' => self::get('hero_title', 'إيد واحدة تغيّر حياة كاملة'),
            'description' => self::get('hero_description', 'نصنع مبادرات تنموية مستدامة'),
        ];
    }
}
