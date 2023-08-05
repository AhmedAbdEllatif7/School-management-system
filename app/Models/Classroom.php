<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['name'];

    protected $table = 'classrooms';
    protected $fillable = ['name', 'grade_id' , 'created_at' , 'updated_at'];
    public $timestamps = true;

    public function grades()
    {
        return $this->belongsTo(\App\Models\Grade::class, 'grade_id');
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }


    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
