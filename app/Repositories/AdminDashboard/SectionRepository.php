<?php

namespace app\Repositories\AdminDashboard;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use app\Repositories\Interefaces\AdminDashboard\SectionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class SectionRepository implements SectionRepositoryInterface
{

    public function index()
    {
        $gradesWithItsSections = Grade::with('sections')->get();
        $AllGrades = Grade::all();
        $teachers = Teacher::all();
        return view('dashboards.admin.sections.index',compact(['gradesWithItsSections' , 'AllGrades' , 'teachers']));
    }





    
    public function store($request)
    {
        try {

            $this->nameExisted($request);
            
                $section = Section::create([
                    'name' => ['en' => $request->name_en , 'ar' => $request->name_ar],
                    'class_id' => $request->class_id,
                    'grade_id' => $request->grade_id,
                    'status' => $request->status,
                ]);
                
                $this->attachTeacher($section , $request);

                return redirect()->back()->with('add_section', trans('sections_trans.Section added successfully.'));
            
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    private function attachTeacher($section , $request)
    {
        $section->teachers()->attach($request->teacher_id);
    }




    private function nameExisted($request)
    {
        $nameExisted = DB::table('sections')
        ->where('name->en' , $request->name_en)
        ->where('name->ar' , $request->name_ar)
        ->where('grade_id' , $request->grade_id)
        ->where('class_id' , $request->class_id)
        ->where('id' , '!=' , $request->id)
        ->exists();

        if($nameExisted)
        {
            return redirect()->back()->with('sections_name_existed', trans('sections_trans.sections_name_existed'));
        }
    }












    public function update($request)
    {

        if($this->nameExisted($request))
        {
            return redirect()->back()->with('sections_name_existed', trans('sections_trans.sections_name_existed'));
        }

        else {
            $section = Section::findOrFail($request->id);
            $section ->update([
                'name' => ['en' => $request->name_en , 'ar' => $request->name_ar],
                'grade_id' => $request->grade_id,
                'class_id' => $request->class_id,
                'status' => $request->status,
            ]);

            $this->syncTeacher($section , $request);

            return redirect()->back()->with('update_section', trans('Sections_trans.Section updated successfully.'));
        }
    }


    private function syncTeacher($section , $request)
    {
        // update pivot table
        if ($request->teacher_id) {
            $section->teachers()->sync($request->teacher_id);
        } else {
            $section->teachers()->sync(array());
        }
    }







    public function destroy($request)
    {
        $section = Section::findOrFail($request->id);
        $section->delete();
        return redirect()->back()->with('delete_section', trans('sections_trans.Section deleted successfully.'));
    }





    //Belongs to ajax
    public function getClases($id)
    {
        $list_classes = Classroom::where("grade_id", $id)->pluck("name", "id");

        return $list_classes;
    }
}
