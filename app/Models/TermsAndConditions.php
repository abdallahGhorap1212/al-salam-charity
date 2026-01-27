<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TermsAndConditions extends Model
{
    protected $fillable = [
        'title',
        'content',
        'summary',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
