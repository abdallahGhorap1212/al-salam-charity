<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Service extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'summary',
        'description',
        'icon',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function getIconUrlAttribute(): ?string
    {
        if (! $this->icon) {
            return null;
        }

        return asset('storage/' . ltrim($this->icon, '/'));
    }
}
