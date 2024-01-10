<?php

namespace App\Http\Controllers\Dashboards\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherProfileRequest;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $information = Teacher::findorFail(auth()->user()->id);
        return view('dashboards.teacher.profile.index', compact('information'));
    }

    public function update(TeacherProfileRequest $request, $id)
    {

        $validatedData = $request->validated();
        $student = Teacher::findorFail($id);

        $formattedName = [
            'en' => $validatedData['name_en'],
            'ar' => $validatedData['name_ar']
        ];
    
        unset($validatedData['name_en'], $validatedData['name_ar']);
    
        $validatedData['name'] = $formattedName;

        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($request->password);
            $student->update($validatedData);
        } 
        else {
            $student->update($validatedData);
        }
        return redirect()->back()->with(['edit_done' => trans('Students_trans.edit_done')]);
    }
}
