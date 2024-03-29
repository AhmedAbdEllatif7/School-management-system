<?php

namespace App\Http\Controllers\Dashboards\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interefaces\AdminDashboard\AttendanceRepositoryInterface;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    protected $attendance;
    public function __construct(AttendanceRepositoryInterface $attendance)
    {
        $this->attendance = $attendance;
    }


    public function index()
    {
        return $this->attendance->index();
    }

    public function store(Request $request)
    {
        return $this->attendance->store($request);

    }

    public function show($id)
    {
        return $this->attendance->show($id);
    }

}
