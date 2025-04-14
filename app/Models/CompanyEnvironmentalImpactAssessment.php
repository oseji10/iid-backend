<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyEnvironmentalImpactAssessment extends Model
{
    use HasFactory;

    protected $table = 'company_environmental_impact_assessment';

    protected $primaryKey = 'impactId';

    protected $fillable = [
        'companyId',
        'typeOfAssessment',
        'degreeOfAbatementOrRemediation',
    ];

    /**
     * Get the company that owns the environmental impact assessment.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'companyId');
    }
}