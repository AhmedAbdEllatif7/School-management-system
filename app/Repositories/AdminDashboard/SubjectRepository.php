<?php

namespace App\Repositories\AdminDashboard;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;
use App\Repositories\Interefaces\AdminDashboard\SubjectRepositoryInterface;

class SubjectRepository implements SubjectRepositoryInterface
{

    public function index()
    {
        $subjects = Subject::select('id', 'name', 'grade_id', 'classroom_id', 'teacher_id')->get();
        return view('dashboards.admin.subjects.index',compact('subjects'));
    }

    public function create()
    {
        $grades = Grade::select('id', 'name')->get();
        $teachers = Teacher::select('id', 'name')->get();
        return view('dashboards.admin.subjects.create',compact('grades','teachers'));
    }



    public function store($request)
    {
        try {
            $validatedData = $request->validated();
            $formattedTitle = $this->formatSubjectTitle($validatedData['name_en'], $validatedData['name_ar']);
    
            unset($validatedData['name_en'], $validatedData['name_ar']);
            $validatedData['name'] = $formattedTitle;
    
            Subject::create($validatedData);
    
            return redirect()->route('subjects.create')->with(['add_done' => trans('Students_trans.add_done')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    
    private function formatSubjectTitle($nameEn, $nameAr)
    {
        return [
            'en' => $nameEn,
            'ar' => $nameAr
        ];
    }
    


    public function edit($id){

        $subject = Subject::select('id', 'name', 'grade_id', 'classroom_id', 'teacher_id')->findOrFail($id);
        $grades = Grade::get();
        $teachers = Teacher::get();
        return view('dashboards.admin.subjects.edit',compact('subject','grades','teachers'));

    }

    public function update($request)
    {
        try {
            $validatedData = $request->validated();
            $formattedTitle = $this->formatSubjectTitle($validatedData['name_en'], $validatedData['name_ar']);

            $subject = Subject::findOrFail($request->id);
            unset($validatedData['name_en'], $validatedData['name_ar']);
            $validatedData['name'] = $formattedTitle;

            $subject->update($validatedData);

            return redirect()->route('subjects.index')->with(['edit_done' => trans('Students_trans.edit_done')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }



    public function destroy($request)
    {
        try {
            $subject = Subject::findOrFail($request->id);
            $subject->delete();
            
            return redirect()->route('subjects.index')->with(['delete_done' => trans('Students_trans.delete_done')]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
