<?php

namespace app\Repositories\AdminDashboard;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Section;
use App\Models\Student;
use app\Repositories\Interefaces\AdminDashboard\PromotionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class PromotionRepository implements PromotionRepositoryInterface
{

    public function index()
    {
        $grades = Grade::all();
        return view('dashboards.admin.promotion.index' , compact('grades'));
    }



    public function create()
    {
        $promotions = promotion::all();
        return view('dashboards.admin.promotion.management',compact('promotions'));
    }




    public function store($request)
    {
        DB::beginTransaction();

        try {
            $students = $this->retrieveStudents($request);

            if ($students->isEmpty()) {
                return redirect()->back()->with('error_promotions', __('No students found.'));
            }

            $this->createOrUpdatePromotions($students, $request);

            DB::commit();
            return redirect()->back()->with(['promotion' => trans('Students_trans.add_promotion')]);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    private function retrieveStudents($request)
    {
        return Student::where('grade_id', $request->from_grade_id)
            ->where('classroom_id', $request->from_classroom_id)
            ->where('section_id', $request->from_section_id)
            ->where('academic_year', $request->from_academic_year)
            ->get();
    }

    private function createOrUpdatePromotions($students, $request)
    {
        $this->updateStudents($students , $request);
        $this->createOrUpdate($students , $request);
    }


    private function updateStudents($students, $request)
    {
        foreach ($students as $student) {
            $student->update([
                'grade_id' => $request->to_grade_id,
                'classroom_id' => $request->to_classroom_id,
                'section_id' => $request->to_section_id,
                'academic_year' => $request->to_academic_year,
            ]);
        }
    }

    private function createOrUpdate($students, $request)
    {
        foreach ($students as $student) {
            Promotion::updateOrCreate([
                'student_id' => $student->id,
                'from_grade_id' => $request->from_grade_id,
                'from_classroom_id' => $request->from_classroom_id,
                'from_section_id' => $request->from_section_id,
                'from_academic_year' => $request->from_academic_year,
                'to_grade_id' => $request->to_grade_id,
                'to_classroom_id' => $request->to_classroom_id,
                'to_section_id' => $request->to_section_id,
                'to_academic_year' => $request->to_academic_year,
            ]);
        }
    }














    public function revertAllPromotions($request)
    {
        try {
                $this->deleteAllPromotions();
                return redirect()->back()->with(['retriveAll' => trans('Students_trans.All promotion return back successfully')]);
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    private function deleteAllPromotions()
    {
        $promotions = Promotion::all();
        foreach ($promotions as $promotion) {
            $this->restoreStudentFromPromotion($promotion);
        }
        Promotion::truncate();
    }


    private function restoreStudentFromPromotion($promotion)
    {
        Student::where('id', $promotion->student_id)
            ->update([
                'grade_id' => $promotion->from_grade_id,
                'classroom_id' => $promotion->from_classroom_id,
                'section_id' => $promotion->from_section_id,
                'academic_year' => $promotion->from_academic_year,
            ]);
    }



    public function revertSelectedPromotions($request)
    {
        try {
            $allRevertedId = explode(",", $request->revert_seleted_id);
            $this->processRevertOfPromotions($allRevertedId);
            return redirect()->back()->with(['promotion_retreved' => trans('students_trans.promotion_retreved')]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    private function processRevertOfPromotions($revertedIds)
    {
        foreach ($revertedIds as $id)
        {
            $promotion = Promotion::findOrFail($id);
            $this->restoreStudentFromPromotion($promotion);
            $this->deletePromotion($promotion);
        }
    }

    private function deletePromotion($promotion)
    {
        $promotion->delete();
    }








    
         // for ajax
    public function getNewClassrooms($id)
    {
        $classroomList = Classroom::where("grade_id", $id)->pluck("name", "id");
        return $classroomList;
    }



    // for ajax
    public function getNewSections($id)
    {
        $sectionList = Section::where("class_id", $id)->pluck("name", "id");
        return $sectionList;
    }
    }

