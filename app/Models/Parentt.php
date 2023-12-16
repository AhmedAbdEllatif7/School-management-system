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
    protected $guarded=[];


    protected $casts = [
        'password' => 'hashed',
    ];

    
    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }
}
