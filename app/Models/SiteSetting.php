<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $table = 'site_settings';

    protected $fillable = [
        'key',
        'value',
        'description',
        'type',
        'category',
    ];

    protected $casts = [
        'value' => 'json',
    ];

    /**
     * Get a setting by key
     */
    public static function get($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Set a setting by key
     */
    public static function set($key, $value, $description = null, $type = 'text', $category = 'general')
    {
        return self::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'description' => $description,
                'type' => $type,
                'category' => $category,
            ]
        );
    }

    /**
     * Get all settings by category
     */
    public static function getByCategory($category)
    {
        return self::where('category', $category)->pluck('value', 'key');
    }

    /**
     * Get all settings grouped by category
     */
    public static function getAllGrouped()
    {
        return self::all()->groupBy('category');
    }
}
