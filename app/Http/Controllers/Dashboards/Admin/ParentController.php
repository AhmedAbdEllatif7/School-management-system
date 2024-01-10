<?php

namespace App\Http\Controllers\Dashboards\Admin;

use App\Http\Controllers\Controller;

class ParentController extends Controller
{

    public function index()
    {
        return view('livewire.parents.index');
    }

}
