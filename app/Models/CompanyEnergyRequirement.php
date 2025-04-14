<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyEnergyRequirement extends Model
{
    use HasFactory;

    protected $table = 'company_energy_requirement';

    protected $fillable = [
        'companyId',
        'averageEnergyConsumptionPerDay',
        'percentageContributionByDisco',
        'percentageContributionByGenerator',
        'percentageContributionByOthers',
        'quantityOfDieselUtilized',
        'quantityOfGasUtilized',
    ];

    /**
     * Get the company that owns the energy requirements.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'companyId');
    }
}