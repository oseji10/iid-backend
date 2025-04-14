<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyFinancial extends Model
{
    use HasFactory;

    protected $table = 'company_financials';

    protected $fillable = [
        'companyId',
        'shareholders',
        'foreignEquity',
        'nigerianEquity',
        'financialPeriod',
        'turnOverPreviousYear',
        'operatingProfitBeforeTax',
        'operatingProfitAfterTax',
        'VAT',
        'companyTax',
        'exciseDuty',
        'initialInvestment',
        'totalFAIFinancialStatement',
        'totalFAIAcceptanceCertificate',
    ];

    /**
     * Get the company that owns the financial details.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'companyId');
    }
}