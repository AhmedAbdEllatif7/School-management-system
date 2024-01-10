<?php

namespace App\Repositories\AdminDashboard;

use App\Events\GraduationStudentDeleting;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Student;
use App\Repositories\Interefaces\AdminDashboard\GraduationRepositoryInterface;

class GraduationRepository implements GraduationRepositoryInterface
{
    public function index()
    {
        $students = Student::onlyTrashed()->get();
        return view('dashboards.admin.graduation.index', compact('students'));
    }



    public function create()
    {
        $grades = Grade::all();
        $students = Student::all();
        $classrooms = Classroom::all();
        $sections = Section::all();
        return view('dashboards.admin.graduation.create', compact(['grades', 'students', 'classrooms', 'sections']));
    }




################## Begin Store #######################################################################################
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
            $student->delete(); // Soft delete
        }
    }
################################################# End Store ######################################################





#################### Begin Restore ######################################################
    public function restored($request)
    {
        try {
            $restore_selected_ids = explode(",", $request->restore_selected_id);
            
            if ($restore_selected_ids) {
                $restoredStudents = $this->restoreStudents($restore_selected_ids);

                return $this->handleRestoreSuccess($restoredStudents);
            }
            
            return $this->handleRestoreFailure();
        } catch (\Exception $e) {
            return $this->handleRestoreError($e->getMessage());
        }
    }

    private function restoreStudents($studentIds)
    {
        return Student::onlyTrashed()->whereIn('id', $studentIds)->get()->each->restore();
    }

    private function handleRestoreSuccess($restoredStudents)
    {
        return redirect()->back()->with(['restored_students' => trans('students_trans.restore_student')]);
    }

    private function handleRestoreFailure()
    {
        return redirect()->back()->withErrors(trans('students_trans.faild_restore'));
    }

    private function handleRestoreError($errorMessage)
    {
        return redirect()->back()->withErrors(['error' => $errorMessage]);
    }
################################################# End Restore ######################################################







#################### Begin Graduated Selected ######################################################
    public function graduateSelected($request)
    {
        try {
            $listOfStudents = $request->listOfStudents;

            $this->processGraduation($listOfStudents);

            return redirect()->back()->with(['graduated' => trans('Students_trans.graduated')]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    private function processGraduation($listOfStudents)
    {
        foreach ($listOfStudents as $student) {
            $selectedStudents = $this->getSelectedStudents($student);

            if ($selectedStudents->isEmpty()) {
                throw new \Exception(trans('Students_trans.not_found_student'));
            }

            $this->deleteSelectedStudents($selectedStudents);
        }
    }

    private function getSelectedStudents($student)
    {
        return Student::where('id', $student['student_id'])->where('email', $student['email'])->get();
    }

    private function deleteSelectedStudents($selectedStudents)
    {
        $selectedStudents->each->delete();
    }
#################### End Graduated Selected ######################################################




################## Begin Force Delete Selected ######################################################
    public function forceDeleteSelected($request)
    {
        try {
            $delete_selected_ids = explode(",", $request->delete_selected_id);

            $this->forceDeleteSelectedStudents($delete_selected_ids);

            return redirect()->back()->with(['delete_Selected' => trans('students_trans.delete_done')]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    private function forceDeleteSelectedStudents($delete_selected_ids)
    {
        foreach ($delete_selected_ids as $id) {
            $student = Student::onlyTrashed()->findOrFail($id);

            $this->deleteStudentData($student);
        }
    }

    private function deleteStudentData($student)
    {
        event(new GraduationStudentDeleting($student));

        $student->forceDelete();
    }
################## End Force Delete Selected ######################################################


}
