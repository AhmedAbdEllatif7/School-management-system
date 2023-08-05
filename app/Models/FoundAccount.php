<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoundAccount extends Model
{
    use HasFactory;

    protected $table = 'found_accounts';

    public $timestamps = true;

    protected $guarded=[];

}
