<?php

namespace App\Repository;

use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use Cassandra\Exception\ValidationException;
use Illuminate\Support\Facades\DB;

class AttendanceRepository implements AttendanceRepositoryInterface
{
    public function index()
    {
        $Grades = Grade::with(['sections'])->get();
        $list_Grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.Attendance.Sections', compact('Grades', 'list_Grades', 'teachers'));
    }

    public function show($id)
    {
        $students = Student::with('attendance')->where('section_id', $id)->get();
        return view('pages.Attendance.index', compact('students' ));
    }


    public function store($request)
    {
        try {

            $attendencee = date('Y-m-d');

                                                //key         //value
            foreach ($request->attendences as $studentid => $attendence) {

                $attendence_status = null; // Initialize the variable

                if ($attendence == 'presence') {
                    $attendence_status = true;
                } else if ($attendence == 'absent') {
                    $attendence_status = false;
                }

                else if ($attendence == 'edit') {
                    foreach ($request->attendences as $studentid => $attendence) {
                        $editAttendance = Attendance::where('student_id', $studentid)->latest()->first();
                        if ($editAttendance->attendance_status == 1) {
                            $editAttendance->attendance_status = 0;
                        } else {
                            $editAttendance->attendance_status = 1;
                        }
                        $editAttendance->save();
                    }
                    return redirect()->back()->with(['edit_done' => trans('Students_trans.edit_done')]);
                }


                Attendance::updateorCreate(

                    [
                        'student_id' => $studentid,
                        'attendance_date' => $attendencee
                    ],
                    [
                    'student_id'=> $studentid,
                    'grade_id'=> $request->grade_id,
                    'classroom_id'=> $request->classroom_id,
                    'section_id'=> $request->section_id,
                    'teacher_id'=> 1,
                    'attendance_date'=> date('Y-m-d'),
                    'attendance_status'=> $attendence_status
                ]);

            }
            return redirect()->back()->with(['add_done' => trans('Students_trans.add_done')]);

        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        $attendance = Attendance::with('students')->findOrFail($id);
        return $attendance;
    }





    public function update($request)
    {
    }

    public function delete($request)
    {
    }

    public function attendance()
    {
        $ids= DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
        $sections = Section::whereIn('id',$ids)->get();
        return view('pages.Teachers.students.attendance' , compact('sections'));
    }

    public function attendanceReport()
    {
        $ids= DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
        $students = Student::whereIn('section_id',$ids)->get();
        return view('pages.Teachers.students.attendance_report',compact('students' ));
    }


    public function attendanceSearch($request)
    {
        try {
            $request->validate([
                'student_id' => 'nullable|integer', // Make sure student_id is an integer if provided
                'from' => 'required|date|date_format:Y-m-d', // Validate from date format
                'to' => 'required|date|date_format:Y-m-d|after_or_equal:from', // Validate to date format and make sure it's after or equal to from date
            ], [
                'from.required' => trans('main_trans.start_date_required'),
                'from.date_format' => trans('main_trans.start_date_format'),
                'to.required' => trans('main_trans.end_date_required'),
                'to.date_format' => trans('main_trans.end_date_format'),
                'to.after_or_equal' => trans('main_trans.end_date_after_or_equal_start'),
            ]);

            $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('section_id');
            $students = Student::whereIn('section_id', $ids)->get();

            if ($request->student_id == 0) {
                $Students = Attendance::whereBetween('attendance_date', [$request->from, $request->to])->get();
                return view('pages.Teachers.students.attendance_report', compact('Students', 'students'));
            } else {
                $Students = Attendance::whereBetween('attendance_date', [$request->from, $request->to])
                    ->where('student_id', $request->student_id)->get();
                return view('pages.Teachers.students.attendance_report', compact('Students', 'students'));
            }
        } catch (ValidationException $e) {
            // Handle validation errors here
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Handle other exceptions here
            // You may log the error or return an error response
            return redirect('attendance-report')->withErrors($e->getMessage());
        }
    }
}
