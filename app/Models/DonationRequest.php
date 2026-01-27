<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DonationRequest extends Model
{
    protected $fillable = [
        'service_id',
        'name',
        'email',
        'phone',
        'amount',
        'notes',
        'status',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
