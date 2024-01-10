<?php

namespace App\Http\Controllers\Dashborads\Teacher;

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

        $information = Teacher::findorFail($id);

        if (!empty($request->password)) {
            $information->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $information->password = Hash::make($request->password);
            $information->save();
        } else {
            $information->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $information->save();
        }
        return redirect()->back()->with(['edit_done' => trans('Students_trans.edit_done')]);


    }
}
