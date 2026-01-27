<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class CaseModel extends Model
{
    use SoftDeletes;

    protected $table = 'cases';

    protected $fillable = [
        'case_number',
        'name',
        'national_id',
        'phone',
        'family_members_count',
        'address',
        'area_id',
        'case_type_id',
        'user_id',
        'notes',
        'barcode',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($case) {
            if (empty($case->case_number)) {
                $case->case_number = 'CASE-' . strtoupper(Str::random(8));
            }
            if (empty($case->barcode)) {
                $case->barcode = 'BC-' . time() . '-' . rand(1000, 9999);
            }
        });
    }

    /**
     * Get the area that owns the case.
     */
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * Get the case type that owns the case.
     */
    public function caseType(): BelongsTo
    {
        return $this->belongsTo(CaseType::class);
    }

    /**
     * Get the user that owns the case.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the files for the case.
     */
    public function files(): HasMany
    {
        return $this->hasMany(CaseFile::class, 'case_id');
    }

    /**
     * Get the aid distributions for the case.
     */
    public function aidDistributions(): HasMany
    {
        return $this->hasMany(AidDistribution::class, 'case_id');
    }
}
