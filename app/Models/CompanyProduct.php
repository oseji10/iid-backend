<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProduct extends Model
{
    use HasFactory;

    protected $table = 'company_products';

    protected $fillable = ['companyId', 'productName'];

    public function company()
    {
        return $this->belongsTo(Company::class, 'companyId');
    }
}