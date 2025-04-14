<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SocialMedia extends Model
{
    use HasFactory;
    
    public $table = 'company_social_media';
    protected $primaryKey = 'socialMediaId';
    protected $fillable = [
        'socialMediaId', 
        'companyId', 
        'socialMediaName', 
        'url', 
        'status'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'companyId', 'companyId');
    }
}
