<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\belongsTo;
class Company extends Model
{
    use HasFactory;
    
    public $table = 'company';
    protected $primaryKey = 'companyId';
    protected $fillable = ['companyId', 'companyName', 'natureOfBusiness', 'companyEmail', 'companyPhone', 
    'companyAddress',
    'companyCity',
    'LGA',
    'state',
    'companyPhone',
    // 'socialMedia',
    // 'companyWebsite',
    'TIN',
    'onStockExchange',
    'dateListedOnSE',
    'dateOfIncorporation',
    'status'
];
    

public function socialMedia()
    {
        return $this->hasMany(SocialMedia::class, 'companyId', 'companyId');
    }

    public function contactPersons()
    {
        return $this->hasMany(ContactPerson::class, 'companyId', 'companyId');
    }

    public function factoryLocations()
    {
        return $this->hasMany(FactoryLocation::class, 'companyId', 'companyId');
    }

    public function productionDetails()
{
    return $this->hasOne(CompanyProductionDetail::class, 'companyId');
}

public function products()
{
    return $this->hasMany(CompanyProduct::class, 'companyId');
}

public function services()
{
    return $this->hasMany(CompanyService::class, 'companyId');
}

public function staffing()
{
    return $this->hasOne(CompanyStaffing::class, 'companyId');
}

// In Company.php
public function financialDetails() { return $this->hasOne(CompanyFinancial::class, 'companyId'); }
public function rawMaterials() { return $this->hasMany(CompanyMajorRawMaterial::class, 'companyId'); }
public function machineryAndEquipment() { return $this->hasMany(CompanyMachineryAndEquipment::class, 'companyId'); }
public function energyRequirements() { return $this->hasOne(CompanyEnergyRequirement::class, 'companyId'); }

public function environmentalImpactAssessment(): HasMany
{
    return $this->hasMany(CompanyEnvironmentalImpactAssessment::class, 'companyId');
}

    /**
     * Get the investment details for the company.
     */
    public function investment(): HasOne
    {
        return $this->hasOne(CompanyInvestment::class, 'companyId');
    }

    /**
     * Get the foreign currency usage records for the company.
     */
    public function foreignCurrencyUsage(): HasMany
    {
        return $this->hasMany(CompanyForeignCurrencyUsage::class, 'companyId');
    }

}
