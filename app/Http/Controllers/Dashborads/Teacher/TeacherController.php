<?php

namespace App\Http\Controllers\Dashborads\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceReportRequest;
use App\Repositories\Interefaces\TeacherDashboard\TeacherRepositoryInterface;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    protected $teacher;

    public function __construct(TeacherRepositoryInterface $teacher)
    {
        $this->teacher = $teacher;
    }
    public function dashboard()
    {
        return $this->teacher->dashboard();
    }


    public function getSections()
    {
        return $this->teacher->getSections();
    }

    public function getStudents()
    {
        return $this->teacher->getStudents();
    }

    public function getAttendance()
    {
        return $this->teacher->getAttendance();
    }

    public function storeAttendance(Request $request)
    {
        return $this->teacher->storeAttendance($request);
    }

    public function getReports()
    {
        return $this->teacher->getReports();
    }

    public function getTeacherStudents()
    {
        return $this->teacher->getTeacherStudents();
    }

    public function reportSearch(AttendanceReportRequest $request)
    {
        return $this->teacher->reportSearch($request);
    }

    public function ajaxGetClassrooms($id)
    {
        return $this->teacher->ajaxGetClassrooms($id);
    }

    public function ajaxGetSections($id)
    {
        return $this->teacher->ajaxGetSections($id);
    }

    }


