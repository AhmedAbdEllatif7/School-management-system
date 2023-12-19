<?php

namespace App\Repositories;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Section;
use App\Models\Student;
use App\Repositories\Interefaces\PromotionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class PromotionRepository implements PromotionRepositoryInterface
{

    public function index()
    {
        $grades = Grade::all();
        return view('pages.adminDashboard.promotion.index' , compact('grades'));
    }



    public function create()
    {
        $promotions = promotion::all();
        return view('pages.adminDashboard.promotion.management',compact('promotions'));
    }


    public function store($request)
    {

        DB::beginTransaction();

        try {
                $students = Student::where('grade_id', $request->from_grade_id)
                    ->where('classroom_id', $request->from_classroom_id)
                    ->where('section_id', $request->from_section_id)
                    ->where('academic_year', $request->from_academic_year)
                    ->get();

                    if ($students->isEmpty()) {
                        return redirect()->back()->with('error_promotions', __('No students found.'));
                    }


                    foreach ($students as $student) {
                        $student->update([
                            'grade_id' => $request->to_grade_id,
                            'classroom_id' => $request->to_classroom_id,
                            'section_id' => $request->to_section_id,
                            'academic_year' => $request->to_academic_year,
                        ]);


                Promotion::updateOrCreate(
                    [
                        'student_id' => $student->id,
                        'from_grade_id' => $request->from_grade_id,
                        'from_classroom_id' => $request->from_classroom_id,
                        'from_section_id' => $request->from_section_id,
                        'from_academic_year' => $request->from_academic_year,
                        'to_grade_id' => $request->to_grade_id,
                        'to_classroom_id' => $request->to_classroom_id,
                        'to_section_id' => $request->to_section_id,
                        'to_academic_year' => $request->to_academic_year,
                    ]
                );
            }

            DB::commit();
            return redirect()->back()->with(['promotion' => trans('Students_trans.add_promotion')]);

        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }



    public function deleteAllPromotion($request)
    {
        DB::beginTransaction();

        try {
            // التراجع عن الكل
            if ($request->page_id == 1) {

                $Promotions = Promotion::all();
                if ($Promotions->isEmpty()) {
                    // Handle the case where no students are found
                    return redirect()->back()->with('error_promotions', __('لم يتم العثور على الطلاب'));
                }

                foreach ($Promotions as $Promotion) {
                    Student::where('id', $Promotion->student_id)->update([
                        'grade_id' => $Promotion->from_grade,
                        'classroom_id' => $Promotion->from_classroom,
                        'section_id' => $Promotion->from_section,
                        'academic_year' => $Promotion->academic_year,
                    ]);

                    //حذف جدول الترقيات
                    Promotion::truncate();

                }
                DB::commit();
                return redirect()->back()->with(['return_back' => trans('Students_trans.All promotion return back successfully')]);
            } else {

                $Promotion = Promotion::findorfail($request->id);
                student::where('id', $Promotion->student_id)
                    ->update([
                        'grade_id' => $Promotion->from_grade,
                        'classroom_id' => $Promotion->from_classroom,
                        'section_id' => $Promotion->from_section,
                        'academic_year' => $Promotion->academic_year,
                    ]);
                Promotion::destroy($request->id);
                DB::commit();
                return redirect()->back()->with(['return_back_student' => trans('Students_trans.restore_student')]);

            }
            }
        catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

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

