<?php

namespace App\Repositories;

use App\Models\Classroom;
use App\Models\Grade;
use App\Repositories\Interefaces\ClassroomRepositoryInterface;

class ClassroomRepository implements ClassroomRepositoryInterface {

    
    public function index()
    {
        $classrooms = Classroom::all();
        $grades = Grade::all();
        return view('dashboards.admin.classrooms.index',compact(['classrooms','grades']));
    }






    public function store($request)
    {
        try {
            $listClasses = $request->listOfClasses;

            $nameExists = $this->checkIfNameExists($listClasses);

            if ($nameExists) {
                return redirect()->back()->withErrors(trans('classes_trans.Sorry this name is already existed for this grade'));
            }

            else {
            $this->createNewClasses($listClasses);
            }

            return redirect()->back()->with('add', trans('classes_trans.Classroom added successfully.'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function checkIfNameExists($listClasses)
    {
        foreach ($listClasses as $class) {
            $nameExists = Classroom::where(function ($query) use ($class) {
                $query->where('name->en', $class['name_en'])
                    ->orWhere('name->ar', $class['name_ar']);
            })
            ->where('grade_id', $class['grade_id'])
            ->exists();

            if ($nameExists) {
                return true;
            }
        }
        return false;
    }


    public function createNewClasses($listClasses)
    {
        foreach ($listClasses as $class) {
            Classroom::create([
                'name' => ['en' => $class['name_en'], 'ar' => $class['name_ar']],
                'grade_id' => $class['grade_id'],
            ]);
        }
    }












    public function update($request)
    {
        try {
            $class = Classroom::findOrFail($request->id);
    
            if ($this->nameExists($request, $class)) {
                return redirect()->back()->withErrors(trans('classes_trans.Sorry this name is already existed for this grade'));
            }
    
            else {
            $this->performUpdate($request, $class);
            return redirect()->back()->with('update', trans('classes_trans.class_updated'));
            }

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    

    private function nameExists($request, $class)
    {
        $nameExists = Classroom::where('grade_id', $request->grade_id)
            ->where(function ($query) use ($request, $class) {
                $query->where('name->en', $request->name_en)
                    ->Where('name->ar', $request->name_ar);

                if ($class->exists) {
                    $query->where('id', '!=', $class->id);
                }
            })
            ->exists();
    
        return $nameExists;
    }
    
    
    private function performUpdate($request, $class)
    {
        $class->update([
            'name' => ['en' => $request->name_en, 'ar' => $request->name_ar],
            'grade_id' => $request->grade_id,
        ]);
    }    










    public function destroy($request)
    {
        $classroom = Classroom::findOrFail($request->id)->delete();
        return redirect()->back()->with('delete', trans('classes_trans.Classroom is deleted successfully.'));
    }











    public function filterClasses($request)
    {
        $search = $this->applyFilters($request->grade_id);
        $grades = Grade::all();
    
        return view('pages.classrooms.index', compact('grades', 'search'));
    }
    
    private function applyFilters($gradeId)
    {
        if ($gradeId && $gradeId == 1) {
            return Classroom::get();
        } else {
            return Classroom::where('grade_id', $gradeId)->get();
        }
    }
    







public function deleteSelectedClassrooms($request)
{
    try {
        $deleteIds = explode(",", $request->delete_all_id);

        $deletedCount = Classroom::whereIn('id', $deleteIds)->delete();

        if ($deletedCount > 0) {
            return redirect()->back()->with('delete_selected', trans('classes_trans.delete_selected'));
        }

        return redirect()->back()->with('delete_selected', trans('classes_trans.No_items_were_deleted'));
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
}

}
