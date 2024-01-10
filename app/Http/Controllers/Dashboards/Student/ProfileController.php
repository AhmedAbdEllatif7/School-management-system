<?php

namespace App\Http\Controllers\Dashboards\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentProfileRequest;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function getProfile()
    {
        $information = Student::select('id', 'name', 'password')->findorFail(auth()->user()->id);
        return view('dashboards.student.profile', compact('information'));
    }


    public function updateProfile(StudentProfileRequest $request, $id)
    {
        $validatedData = $request->validated();
        $student = Student::findorFail($id);

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
        return redirect()->back()->with('edit_done', trans('Students_trans.edit_done'));
    }

}
