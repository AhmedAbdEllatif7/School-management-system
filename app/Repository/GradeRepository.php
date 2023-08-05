<?php

namespace App\Repository;

use App\Models\Grade;

class GradeRepository implements GradeRepositoryInterface
{

    public function index()
    {
        $grades = Grade::all();
        return view('pages.Grades.grade',compact('grades'));
    }

    public function store($request)
    {
        $List_Grades = $request->List_Grades;

        try {
            $validated = $request->validated();

            foreach ($List_Grades as $List_Grade) {

                if(Grade::where('name->en',$List_Grade['name_en'])->orWhere('name->ar',$List_Grade['name_en'])->exists() )
                {
                    return redirect()->back()->withErrors(trans('grade_trans.Sorry this name is already existed'));
                }
                $Grade = new Grade();

                $Grade->name = ['en' => $List_Grade['name_en'], 'ar' => $List_Grade['name_ar']];

                $Grade->notes = $List_Grade['notes'];

                $Grade->save();

            }
            return redirect()->back()->with('add', trans('grade_trans.Grade added successfully.'));

        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function update($request)
    {
        $existingGrade = Grade::where(function ($query) use ($request) {
            $query->where('name->en', $request->name_en)
                ->orWhere('name->ar', $request->name_ar);
        })
            ->where('id', '!=', $request->id)
            ->exists();

        if ($existingGrade) {
            return redirect()->back()->withErrors(trans('grade_trans.Sorry this name is already existed'));
        }
        try {
            $validated = $request->validated();
            $grade = Grade::findOrFail($request->id);
            $grade->update([
                'name' => ['ar' => $request->name_ar, 'en' =>$request->name_en],
                'notes' => $request->notes,
            ]);
            return redirect()->back()->with('update', trans('grade_trans.Grade update successfully.'));

        }
        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete($request)
    {
        $grade = Grade::findOrFail($request->id);
        $grade->delete();

        return redirect()->back()->with('delete', trans('grade_trans.Grade deleted successfully.'));

    }

    public function deleteSelected($request)
    {
        $selectedIds = $request->input('selected', []);
        Grade::whereIn('id', $selectedIds)->delete();
        return redirect()->back()->with('delete', trans('Selected grades have been deleted.'));    }

    public function deleteAllGrade($request)
    {
        $delete_all_id = explode(",", $request->delete_all_id);

        Grade::whereIn('id', $delete_all_id)->Delete();
        return redirect()->back()->with(['delete_selected' => trans('grade_trans.selected_deleted_successfully')]);
    }
}
