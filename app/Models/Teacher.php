<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use mysql_xdevapi\Table;
use Spatie\Translatable\HasTranslations;

class Teacher extends Authenticatable
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['name'];
    protected $fillable = ['name' , 'email' , 'password' , 'gender_id' , 'specialization_id' , 'joining_date' , 'address', 'created_at', 'updated_at'];
    protected $table  = 'teachers';

    public $timestamps = true;

    protected $casts = [
        'password' => 'hashed',
    ];

    // علاقة بين المعلمين والتخصصات لجلب اسم التخصص
    public function specializations()
    {
        return $this->belongsTo('App\Models\Specialization', 'specialization_id');
    }

    // علاقة بين المعلمين والانواع لجلب جنس المعلم
    public function genders()
    {
        return $this->belongsTo('App\Models\Gender', 'gender_id');
    }

    // علاقة المعلمين مع الاقسام
    public function sections()
    {
        return $this->belongsToMany('App\Models\Section','teacher_section');
    }

    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }
}
