<?php

namespace App\Repository;

use App\Models\Classroom;
use App\Models\Grade;

class ClassroomRepository implements ClassroomRepositoryInterface{

    public function index()
    {
        $My_Classes = Classroom::all();
        $Grades = Grade::all();
        return view('pages.My_Classes.My_Classes',compact(['My_Classes','Grades']));
    }

    public function store($request)
    {
        $listClasses = $request->List_Classes;
        $nameExists = false; // Flag to track duplicate names

        try {
            $validated = $request->validated();

            foreach ($listClasses as $class) {
                if (Classroom::where('name->en', $class['name_en'])
                    ->where('grade_id', $class['grade_id'])
                    ->orWhere('name->ar', $class['name_en'])
                    ->where('grade_id', $class['grade_id'])
                    ->exists()
                ) {
                    $nameExists = true; // Set the flag if name exists
                } else {
                    $newClass = new Classroom();
                    $newClass->name = ['en' => $class['name_en'], 'ar' => $class['name_ar']];
                    $newClass->grade_id = $class['grade_id'];
                    $newClass->save();
                }
            }

            if ($nameExists) {
                return redirect()->back()->withErrors(trans('My_Classes_trans.Sorry this name is already existed for this grade'));
            }

            return redirect()->back()->with('add', trans('My_Classes_trans.Classroom added successfully.'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request)
    {
//        $validated = $request->validated();

        $classroom = Classroom::findOrFail($request->id);
        $classroom ->update([
            'name' => ['en' => $request->name_en , 'ar' => $request->name_ar],
            'grade_id' => $request->grade_id,
        ]);
        return redirect()->back()->with('update', trans('My_Classes_trans.Classroom is update successfully.'));

    }

    public function destroy($request)
    {
        $classroom = Classroom::findOrFail($request->id);
        $classroom->delete();
        return redirect()->back()->with('delete', trans('My_Classes_trans.Classroom is deleted successfully.'));

    }

    public function filterClasses($request)
    {
        if ($request->grade_id && $request->grade_id == 1) {
            $search = Classroom::get();
            $Grades = Grade::all();

        } else {
            $search = Classroom::select('*')->where('grade_id', $request->grade_id)->get();
            $Grades = Grade::all();
        }

        return view('pages.My_Classes.My_Classes', compact('Grades', 'search'));
    }

    public function deleteAll($request)
    {
        $delete_all_id = explode(",", $request->delete_all_id);

        Classroom::whereIn('id', $delete_all_id)->Delete();
        return redirect()->back()->with(['delete_selected' => 'The selected items are deleted successfully']);
    }
}
