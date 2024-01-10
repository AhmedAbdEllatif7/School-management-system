<?php

namespace App\Http\Controllers\Dashborads\Admin;

use App\Http\Controllers\Controller;

class ParentController extends Controller
{

    public function index()
    {
        return view('livewire.parents.index');
    }

}
