<?php

namespace App\Repositories;

use App\Models\Grade;
use App\Repositories\Interefaces\GradeRepositoryInterface;

class GradeRepository implements GradeRepositoryInterface
{

    public function index()
    {
        $grades = Grade::all();
        return view('pages.grades.index',compact('grades'));
    }





    public function store($request)
    {
        $listGrades = $request->listOfGrades;
        $success = $this->storeGrades($listGrades);
    
        if ($success) {
            return redirect()->back()->with('add', trans('grade_trans.Grade added successfully.'));
        } else {
            return redirect()->back()->withErrors(['error' => trans('grade_trans.grade_already_exists')]);
        }
    }
    
    public function storeGrades($grades)
    {
        $success = true; // Track if all grades were successfully added
    
        foreach ($grades as $gradeData) {
            if ($this->uniqueStoreValidation($gradeData)) {
                $this->createGrade($gradeData);
            } else {
                $success = false; // If any grade fails validation, set success to false
            }
        }
        
        return $success; // Return success status after looping through all grades
    }
    


    public function createGrade($data)
    {
        $grade = new Grade();
        if ($grade) {
            $grade->name = ['en' => $data['name_en'], 'ar' => $data['name_ar']];
            $grade->notes = $data['notes'];
            $grade->save();
        }
    }



    public function uniqueStoreValidation($listGrade)
    {
        return !Grade::where('name->en', $listGrade['name_en'])
            ->orWhere('name->ar', $listGrade['name_ar'])
            ->exists();
    }





    public function update($request)
    {
        try {

            if ($this->uniqueUpdateValidation($request))
            {
                return redirect()->back()->withErrors(trans('grade_trans.grade_already_exists'));
            }
            
            else {
            $grade = Grade::findOrFail($request->id);
            $this->updateGrade($grade, $request);

            return redirect()->back()->with('update', trans('grade_trans.Grade update successfully.'));
            }
            
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    private function updateGrade($grade, $requestData)
    {
        $grade->update([
            'name' => ['ar' => $requestData->name_ar, 'en' => $requestData->name_en],
            'notes' => $requestData->notes,
        ]);
    }


    public function uniqueUpdateValidation($request)
    {
        $existingGrade = Grade::where(function ($query) use ($request) {
                $query->where('name->en', $request->name_en)
                    ->orWhere('name->ar', $request->name_ar);
            })
            ->where('id', '!=', $request->id)
            ->exists();

        if ($existingGrade) {
            return $existingGrade;
        }
    }








    public function delete($request)
    {
        try {
            $grade = Grade::findOrFail($request->id);
            if ($grade) {
                $grade->delete();
                return redirect()->back()->with('delete', trans('grade_trans.Grade deleted successfully.'));
            }
            return redirect()->back()->withErrors(trans('grade_trans.Failed to delete grade.'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    








    public function deleteSelectedGrades($request)
    {
        try {
            $delete_all_id = explode(",", $request->delete_all_id);
    
            $deleted = Grade::whereIn('id', $delete_all_id)->delete();
            if ($deleted) {
                return redirect()->back()->with(['delete_selected' => trans('grade_trans.selected_deleted_successfully')]);
            }
            return redirect()->back()->withErrors(trans('grade_trans.Failed to delete selected grades.'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    
}
