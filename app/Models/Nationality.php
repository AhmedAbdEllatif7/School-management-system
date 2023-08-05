<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Nationality extends Model
{
    use HasFactory;
    use HasTranslations;
    protected $table = 'nationalities';
    public $translatable = ['name'];
    protected $fillable = ['name']; //protected $guarded = []; fillable دة بيخليك تحط كل عناصر ال داتابيز بدل ماتدخلهم كلهم في ال
    public $timestamps = true;
}
