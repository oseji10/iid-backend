<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class FactoryLocation extends Model
{
    use HasFactory;
    
    public $table = 'company_factory_location';
    protected $primaryKey = 'factoryId';
    protected $fillable = [
        'factoryId', 
        'companyId', 
        'locationName', 
        'status',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'companyId', 'companyId');
    }
}
