<?php

namespace App\Http\Controllers\school\admin;

use App\Http\Controllers\Controller;

class ParentController extends Controller
{

    public function index()
    {
        return view('livewire.parents.index');
    }

}
