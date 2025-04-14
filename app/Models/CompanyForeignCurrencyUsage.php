<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyForeignCurrencyUsage extends Model
{
    use HasFactory;

    protected $table = 'company_foreign_currency_usage';

    protected $primaryKey = 'usageId';

    protected $fillable = [
        'companyId',
        'importedItemName',
        'FX',
        'currencyType',
    ];

    /**
     * Get the company that owns the foreign currency usage.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'companyId');
    }
}