<?php

namespace App\Repositories;

use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Teacher;
use App\Repositories\Interefaces\AttendanceRepositoryInterface;


class AttendanceRepository implements AttendanceRepositoryInterface
{

    //show secions
    public function index()
    {
        $sectionsOfGrade = Grade::with(['sections'])->get();
        $grades = Grade::select('id', 'name')->get();
        return view('dashboards.admin.attendance.index', compact('sectionsOfGrade', 'grades'));
    }


    //show attendance
    public function show($id)
    {
        $students = Student::with('attendance')->where('section_id', $id)->get();
        $teachers = Teacher::select('id', 'name')->get();
        return view('dashboards.admin.attendance.studentAttendance', compact('students', 'teachers'));
    }




################## Begin Store ###################################################################
    public function store($request)
    {
        try {
            foreach ($request->attendences as $studentId => $attendance) {
                if ($attendance === 'edit') {
                    $this->editAttendance($studentId);
                } else {
                    $this->createOrUpdateAttendance($studentId, $attendance, $request);
                }
            }

            return redirect()->back()->with(['add_done' => trans('Students_trans.add_done')]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    private function createOrUpdateAttendance($studentId, $attendance, $request)
    {
        $attendanceDate = date('Y-m-d');
        $attendanceStatus = $this->mapAttendanceStatus($attendance);

        Attendance::updateOrCreate(
            [
                'student_id' => $studentId,
                'attendance_date' => $attendanceDate
            ],
            [
                'student_id' => $studentId,
                'grade_id' => $request->grade_id,
                'classroom_id' => $request->classroom_id,
                'section_id' => $request->section_id,
                'teacher_id' => 1, // Assuming a default admin ID because admin that take attendance on this case
                'attendance_date' => $attendanceDate,
                'attendance_status' => $attendanceStatus
            ]
        );
    }

    private function editAttendance($studentId)
    {
        $editAttendance = Attendance::where('student_id', $studentId)->latest()->first();
        if ($editAttendance->attendance_status == 1) {
            $editAttendance->attendance_status = 0;
        } else {
            $editAttendance->attendance_status = 1;
        }
        $editAttendance->save();
    }

    private function mapAttendanceStatus($attendance)
    {
        if ($attendance === 'presence') {
            return true;
        } elseif ($attendance === 'absent') {
            return false;
        }

        return null; // Or handle other cases as needed
    }
################## End Store ###################################################################


    
}
