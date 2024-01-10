<?php

namespace App\Http\Controllers\Dashboards\Parent;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParentProfileRequest;
use App\Models\Parentt;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $information = Parentt::findorFail(auth()->user()->id);
        return view('dashboards.parent.profile.index', compact('information'));
    }

    public function update(ParentProfileRequest $request, $id)
{
    $validatedData = $request->validated();
    $parent = Parentt::findorFail($id);

    $formattedName = [
        'en' => $validatedData['name_en'],
        'ar' => $validatedData['name_ar']
    ];

    unset($validatedData['name_en'], $validatedData['name_ar']);

    $validatedData['father_name'] = $formattedName;

    if (!empty($validatedData['password'])) {
        $validatedData['password'] = Hash::make($request->password);
    }

    $parent->update($validatedData);

    return redirect()->back()->with(['edit_done' => trans('Students_trans.edit_done')]);
}

}
