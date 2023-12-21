<?php

namespace App\Repositories;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Student;
use App\Repositories\Interefaces\GraduationRepositoryInterface;

class GraduationRepository implements GraduationRepositoryInterface
{
    public function index()
    {
        $students = Student::onlyTrashed()->get();
        return view('pages.adminDashboard.graduation.index', compact('students'));
    }



    public function create()
    {
        $grades = Grade::all();
        $students = Student::all();
        $classrooms = Classroom::all();
        $sections = Section::all();
        return view('pages.adminDashboard.graduation.create', compact(['grades', 'students', 'classrooms', 'sections']));
    }





    public function store($request)
    {
        $students = $this->fetchStudents($request);

        if ($students->isEmpty()) {
            return redirect()->back()->with(['error_Graduated' => trans('Students_trans.Sorry students not found')]);
        } else {
            $this->deleteStudents($students);
            return redirect()->back()->with(['graduated' => trans('Students_trans.graduated')]);
        }
    }

    private function fetchStudents($request)
    {
        return Student::where('grade_id', $request->grade_id)
            ->where('classroom_id', $request->classroom_id)
            ->where('section_id', $request->section_id)
            ->get();
    }

    private function deleteStudents($students)
    {
        foreach ($students as $student) {
            $student->delete();
        }
    }


    public function returnAllGraduatedBack()
    {
        Student::onlyTrashed()->restore();
        return redirect()->back()->with(['restore_Graduated' => trans('Students_trans.restore')]);

    }

    public function returnStudent($request)
    {

        $student = Student::withTrashed()->find($request->id);
        $student->restore();
        return redirect()->back()->with(['restore_Graduated' => trans('Students_trans.restore')]);

    }

    public function forceDelete($request)
    {
        $student = Student::withTrashed()->findOrFail($request->id)->forceDelete();

        return redirect()->back()->with(['delete_force' => trans('Students_trans.Deleted successfully')]);
    }

    public function graduateSelectes($request)
    {
        $list_students = $request->List_Student;

        try {
            foreach ($list_students as $student) {
                $student2 = Student::where('id', $student['student_id'])->where('email', $student['email'])->first();

                if ($student2) {
                    $student2->delete();
                } else {
                    return redirect()->back()->with(['error_Graduated' => trans('Students_trans.invalid_data')]);
                }
            }

            return redirect()->back()->with(['graduated' => trans('Students_trans.graduated')]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



}
