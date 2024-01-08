<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPayment extends Model
{
    use HasFactory;

    protected $table = 'student_payments';

    public $timestamps = true;

    protected $fillable = ['student_id', 'amount', 'description', 'date']; // Adjust as per your fields

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }

}
