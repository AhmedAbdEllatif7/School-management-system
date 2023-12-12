<?php

namespace App\Repositories;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use App\Repositories\Interefaces\SectionRepositoryInterface;

class SectionRepository implements SectionRepositoryInterface
{

    public function index()
    {
        $Grades = Grade::with('sections')->get();
        $list_Grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.Sections.Sections',compact(['Grades' , 'list_Grades' , 'teachers']));
    }

    public function store($request)
    {
        try {
            $Sections = Section::create([
                'name' => ['en' => $request->name_en , 'ar' => $request->name_ar],
                'class_id' => $request->Class_id,
                'grade_id' => $request->Grade_id,
                'status' => $request->status,
            ]);
            $Sections->teachers()->attach($request->teacher_id);

            return redirect()->back()->with('add_section', trans('Sections_trans.Section added successfully.'));
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request)
    {
        $section = Section::findOrFail($request->id);
        $section ->update([
            'name' => ['en' => $request->name_en , 'ar' => $request->name_ar],
            'grade_id' => $request->Grade_id,
            'class_id' => $request->Class_id,
            'status' => $request->status,
        ]);

        // update pivot tABLE
        if ($request->teacher_id) {
            $section->teachers()->sync($request->teacher_id);
        } else {
            $section->teachers()->sync(array());
        }
        return redirect()->back()->with('update_section', trans('Sections_trans.Section updated successfully.'));
    }

    public function destroy($request)
    {
        $section = Section::findOrFail($request->id);
        $section->delete();
        return redirect()->back()->with('delete_section', trans('Sections_trans.Section deleted successfully.'));
    }

    public function getClases($id)
    {
        $list_classes = Classroom::where("grade_id", $id)->pluck("name", "id");

        return $list_classes;
    }
}
