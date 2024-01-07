<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Fee extends Model
{
    use HasFactory;
    use HasTranslations;
        public $translatable = ['title'];

    protected $table = 'fees';


    public $timestamps = true;

    protected $guarded=[];

    public function grades()
    {
        return $this->belongsTo(\App\Models\Grade::class, 'grade_id');
    }
    public function classrooms()
    {
        return $this->belongsTo(\App\Models\Classroom::class , 'classroom_id');
    }

}
