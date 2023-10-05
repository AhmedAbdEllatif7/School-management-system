<?php

namespace App\Http\Controllers\school\admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Repository\AttendanceRepositoryInterface;
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


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        return $this->attendance->store($request);

    }

    public function show($id)
    {
        return $this->attendance->show($id);
    }


    public function edit(Attendance $attendance)
    {
        //
    }

    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    public function destroy(Attendance $attendance)
    {
        //
    }

    public function editStudentPresence($id)
    {
        return $this->attendance->edit($id);
    }

    public  function getAttendance()
    {
        return $this->attendance->attendance();

    }

    public function attendanceReport()
    {
        return $this->attendance->attendanceReport();

    }


    public function attendanceSearch(Request $request)
    {
        return $this->attendance->attendanceSearch($request);

    }

}
