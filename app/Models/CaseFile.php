<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CaseFile extends Model
{
    protected $fillable = [
        'case_id',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
        'description',
    ];

    /**
     * Get the case that owns the file.
     */
    public function case(): BelongsTo
    {
        return $this->belongsTo(CaseModel::class, 'case_id');
    }
}
