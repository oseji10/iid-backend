<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyService extends Model
{
    use HasFactory;

    protected $table = 'company_services';

    protected $fillable = ['companyId', 'serviceName'];

    public function company()
    {
        return $this->belongsTo(Company::class, 'companyId');
    }
}