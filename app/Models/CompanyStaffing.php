<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyStaffing extends Model
{
    use HasFactory;

    protected $table = 'company_staffing';

    protected $fillable = [
        'companyId',
        'staffStrength',
        'directorExpatriate',
        'directorNigerian',
        'managementExpatriate',
        'managementNigerian',
        'otherStaffSkilled',
        'otherStaffUnskilled',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'companyId');
    }
}