<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ContactPerson extends Model
{
    use HasFactory;
    
    public $table = 'company_contact_persons';
    protected $primaryKey = 'contactPersonId';
    protected $fillable = [
        'contactPersonId', 
        'companyId', 
        'staffName', 
        'designation', 
        'phoneNumber',
        'email',
        'signature',
        'status',
        'isContactPerson'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'companyId', 'companyId');
    }
}
