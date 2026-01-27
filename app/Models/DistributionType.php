<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DistributionType extends Model
{
    protected $fillable = [
        'name',
        'ar_name',
        'description',
        'icon',
        'color',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the distributions of this type.
     */
    public function distributions(): HasMany
    {
        return $this->hasMany(AidDistribution::class);
    }

    /**
     * Get active distribution types ordered by order field.
     */
    public static function active()
    {
        return self::where('is_active', true)->orderBy('order')->get();
    }
}
