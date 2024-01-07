<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessingFee extends Model
{
    use HasFactory;

    protected $table = 'processing_fees';

    public $timestamps = true;

    protected $guarded=[];

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }

}
