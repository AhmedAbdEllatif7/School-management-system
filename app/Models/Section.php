<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['name'];
    protected $fillable = ['name' , 'status' , 'class_id' ,'grade_id'];
    protected $table = 'sections';
    public $timestamps = true;



    public function grades()
    {
        return $this->belongsTo(\App\Models\Grade::class , 'grade_id');
    }

    public function classes()
    {
        return $this->belongsTo(\App\Models\Classroom::class , 'class_id');
    }

    public function teachers()
    {
        return $this->belongsToMany('App\Models\Teacher','teacher_section');
    }


    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
