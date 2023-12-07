<?php

namespace App\Http\Controllers\school\student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function index()
    {
        $information = Student::findorFail(auth()->user()->id);
        return view('pages.Students.profile', compact('information'));
    }

    // public function create()
    // {
    //     //
    // }

    // public function store(Request $request)
    // {
    //     //
    // }



    // public function show(string $id)
    // {
    //     //
    // }

    // public function edit(string $id)
    // {
    //     //
    // }


    public function update(Request $request,$id)
    {
        $information = Student::findorFail($id);

        if (!empty($request->password)) {
            $information->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->password = Hash::make($request->password);
            $information->save();
        } else {
            $information->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->save();
        }
        return redirect()->back()->with('edit_done', trans('Students_trans.edit_done'));
    }

    public function destroy(string $id)
    {
        //
    }
}
