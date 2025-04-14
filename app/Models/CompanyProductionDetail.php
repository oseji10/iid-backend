<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProductionDetail extends Model
{
    use HasFactory;

    protected $table = 'company_production_details';

    protected $fillable = [
        'companyId',
        'dateProductionStarted',
        'productsAndServices',
        'designedInstalledCapacity',
        'operatingCapacity',
        'percentageForExport',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'companyId');
    }
}