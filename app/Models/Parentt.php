<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;

class Parentt extends Authenticatable
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['father_name' , 'father_job' , 'mother_name' , 'mother_job'];
    protected $table = 'parents';

    protected $fillable = [
        'email',
        'password',
        'father_name',
        'father_national_id',
        'father_passport_id',
        'father_phone',
        'father_job',
        'father_nationality',
        'father_blood_type',
        'father_religion',
        'father_address',
        'mother_name',
        'mother_national_id',
        'mother_passport_id',
        'mother_phone',
        'mother_job',
        'mother_nationality',
        'mother_blood_type',
        'mother_religion',
        'mother_address',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    
    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }
}
