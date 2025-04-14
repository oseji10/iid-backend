<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyMajorRawMaterial extends Model
{
    use HasFactory;

    protected $table = 'company_major_raw_materials';

    protected $fillable = [
        'companyId',
        'foreignItem',
        'foreignItemQuantity',
        'localItem',
        'localItemQuantity',
    ];

    /**
     * Get the company that owns the raw material.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'companyId');
    }
}