<?php

namespace app\Repositories\TeacherDashboard;

use app\Repositories\Interefaces\TeacherDashboard\TeacherRepositoryInterface;
use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TeacherRepository implements TeacherRepositoryInterface {

    public function dashboard()
    {
        $ids = Teacher::findorFail(auth()->user()->id)->sections()->pluck('section_id');
        $sectionsCount = $ids->count();
        $studentsCount= \App\Models\Student::whereIn('section_id',$ids)->count();

        return view('dashboards.teacher.dashboard', compact('sectionsCount', 'studentsCount'));
    }


    public function getSections()
    {
        $sections = Teacher::findorFail(auth()->user()->id)->sections()->get();
        return view('dashboards.teacher.sections.index', compact('sections'));
    }


    public function getStudents()
    {
        $sections = Teacher::findorFail(auth()->user()->id)->sections()->get();
        $sectionsIds = Teacher::findorFail(auth()->user()->id)->sections()->pluck('section_id');
        $students = Student::whereIn('section_id',$sectionsIds)->select('name', 'grade_id', 'classroom_id')->get();

        return view('dashboards.teacher.students.index', compact('students', 'sections'));
    }


    public function getAttendance()
    {
        $sections = Teacher::findorFail(auth()->user()->id)->sections()->get();
        $grades = Grade::select('id', 'name')->get();

        return view('dashboards.teacher.attendance.index', compact('grades', 'sections'));
    }


################## Begin Store ###################################################################
    public function storeAttendance($request)
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
                'teacher_id' => Auth::id(),
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

        return null; 
    }
################## End Store ###################################################################



    public function getReports()
    {
        $sectionsIds = Teacher::findorFail(auth()->user()->id)->sections()->pluck('section_id');
        $students = Student::whereIn('section_id',$sectionsIds)->select('id', 'name', 'grade_id', 'classroom_id', 'section_id')->get();
        return view('dashboards.teacher.attendance.reports', compact('students'));
    }



    public function getTeacherStudents()
    {
        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        return Student::whereIn('section_id', $ids)->select('id', 'name', 'grade_id', 'classroom_id', 'section_id')->get();
    }
    
    public function reportSearch($request)
    {
        $students = $this->getTeacherStudents();
    
        if ($request->student_id == 0) {
            $searchResult = Attendance::whereBetween('attendance_date', [$request->from, $request->to])->get();
        } else {
            $searchResult = Attendance::whereBetween('attendance_date', [$request->from, $request->to])
                ->where('student_id', $request->student_id)->get();
        }
    
        return view('dashboards.teacher.attendance.reports', compact('searchResult', 'students'));
    }
    

    // for ajax
    public function ajaxGetClassrooms($id)
    {
        $classroomList = Classroom::where("grade_id", $id)->pluck("name", "id");
        return $classroomList;
    }



    // for ajax
    public function ajaxGetSections($id) 
    {
        $sectionList = Section::where("class_id", $id)->pluck("name", "id");
        return $sectionList;
    }

}