<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGrade;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        return view('auth.selection');
    }

    public function adminDashboard()
    {
        return view('dashboards.admin.dashboard');
    }


}
