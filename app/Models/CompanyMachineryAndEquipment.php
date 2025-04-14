<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyMachineryAndEquipment extends Model
{
    use HasFactory;

    protected $table = 'company_machinery_and_equipment';

    protected $fillable = [
        'companyId',
        'equipmentName',
        'sourceOfMachinery',
    ];

    /**
     * Get the company that owns the machinery and equipment.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'companyId');
    }
}