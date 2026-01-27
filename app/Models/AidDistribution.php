<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AidDistribution extends Model
{
    protected $fillable = [
        'case_id',
        'user_id',
        'distribution_date',
        'notes',
    ];

    protected $casts = [
        'distribution_date' => 'datetime',
    ];

    /**
     * Get the case that owns the aid distribution.
     */
    public function case(): BelongsTo
    {
        return $this->belongsTo(CaseModel::class, 'case_id');
    }

    /**
     * Get the user who recorded the distribution.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
