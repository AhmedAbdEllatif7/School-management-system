<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['name'];

    protected $table = 'grades';
    protected $fillable = ['name', 'notes' , 'created_at' , 'updated_at'];
    public $timestamps = true;

    public function sections()
    {
        return $this->hasMany(\App\Models\Section::class , 'grade_id');
    }
}
