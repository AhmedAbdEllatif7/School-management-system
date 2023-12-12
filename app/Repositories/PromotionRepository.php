<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class PromotionRepository implements PromotionRepositoryInterface
{

    public function index()
    {
        $Grades = Grade::all();
        return view('pages.Students.promotion.index' , compact('Grades'));

    }


    public function storePromotion($request)
    {

        DB::beginTransaction();

        try {
            $students = Student::where('grade_id', $request->Grade_id)
                ->where('classroom_id', $request->Classroom_id)
                ->where('section_id', $request->section_id)
                ->where('academic_year', $request->academic_year)
                ->get();

            if ($students->isEmpty()) {
                // Handle the case where no students are found
                return redirect()->back()->with('error_promotions', __('لم يتم العثور على الطلاب'));
            }

            foreach ($students as $student) {
                $student->update([
                    'grade_id' => $request->Grade_id_new,
                    'classroom_id' => $request->Classroom_id_new,
                    'section_id' => $request->section_id_new,
                    'academic_year' => $request->academic_year_new,
                ]);


                Promotion::updateOrCreate(
                    [
                        'student_id' => $student->id,
                        'from_grade' => $request->Grade_id,
                        'from_classroom' => $request->Classroom_id,
                        'from_section' => $request->section_id,
                        'academic_year' => $request->academic_year,
                        'to_grade' => $request->Grade_id_new,
                        'to_classroom' => $request->Classroom_id_new,
                        'to_section' => $request->section_id_new,
                        'academic_year_new' => $request->academic_year_new,
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

    public function create()
    {
        $promotions = promotion::all();
        return view('pages.Students.promotion.management',compact('promotions'));
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














}
