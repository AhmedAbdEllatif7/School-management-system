<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_Account extends Model
{
    use HasFactory;

    protected $table = 'student__accounts';

    protected $fillable = ['date' , 'type' , 'fee_invoice_id' , 'receipt_id' , 'processing_id' , 'student_id' , 'Debit' , 'credit' , 'Debit' , 'credit' , 'description'];

    public $timestamps = true;

    public function students()
    {
        return $this->belongsTo('App\Models\Student' , 'student_id');
    }


}
