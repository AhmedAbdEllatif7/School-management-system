<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $table = 'promotions';

    public $timestamps = true;

    protected $fillable = [
        'student_id' ,
        'from_grade_id' ,
        'from_classroom_id' , 
        'from_section_id' ,
        'to_grade_id' , 
        'to_classroom_id' , 
        'to_section_id' ,
        'from_academic_year' , 
        'to_academic_year'
    ];


    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }

    public function fromGrade()
    {
        return $this->belongsTo('App\Models\Grade', 'from_grade_id');
    }
    
    public function fromClassroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'from_classroom_id');
    }
    
    public function fromSection()
    {
        return $this->belongsTo('App\Models\Section', 'from_section_id');
    }
    
    public function toGrade()
    {
        return $this->belongsTo('App\Models\Grade', 'to_grade_id');
    }
    
    public function toClassroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'to_classroom_id');
    }
    
    public function toSection()
    {
        return $this->belongsTo('App\Models\Section', 'to_section_id');
    }
    



}
