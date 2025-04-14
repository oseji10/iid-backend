<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyInvestment extends Model
{
    use HasFactory;

    protected $table = 'company_investment';

    protected $primaryKey = 'investmentId';

    protected $fillable = [
        'companyId',
        'FDI',
        'foreign',
    ];

    /**
     * Get the company that owns the investment.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'companyId');
    }
}