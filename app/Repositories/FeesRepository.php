<?php

namespace App\Repositories;

use App\Models\Fees;
use App\Models\Grade;
use App\Repositories\Interefaces\FeesRepositoryInterface;

class FeesRepository implements FeesRepositoryInterface
{
    public function index()
    {
        $fees = Fees::all();
        return view('pages.Fees.index' , compact('fees'));
    }


    public function create()
    {
        $Grades = Grade::all();
        return view('pages.Fees.add' , compact('Grades'));
    }


    public function storeFees($request)
    {
        $fees = new Fees();
        $fees->title  = ['en' => $request->title_en , 'ar' => $request->title_ar];
        $fees->amount = $request->amount;
        $fees->grade_id = $request->Grade_id;
        $fees->classroom_id = $request->Classroom_id;
        $fees->description = $request->description;
        $fees->year = $request->year;
        $fees->fee_type = $request->Fee_type;
        $fees->save();

        return redirect()->back()->with(['store_fees' =>'fees_stored']);
    }


    public function editFees($fee_id)
    {
        $Grades = Grade::all();
        $fee = Fees::findOrFail($fee_id);
        return view('pages.Fees.edit' , compact(['Grades' , 'fee']));
    }


     public function updateFees($request)
     {
         $fees = Fees::findOrFail($request->id);
         $fees->update([
             'title' => ['en' => $request->title_en, 'ar' => $request->title_ar],
             'amount' => $request->amount,
             'grade_id' => $request->Grade_id,
             'classroom_id' => $request->Classroom_id,
             'description' => $request->description,
             'year' => $request->year,
             'fee_type' => $request->Fee_type,
         ]);

         return redirect()->route('fees.index')->with(['update_fees' => 'Fees updated successfully']);

     }

     public function deleteFees($request)
     {
            $fees = Fees::findOrFail($request->id)->delete();
         return redirect()->route('fees.index')->with(['delete_fees' => 'Fees deleted successfully']);

     }



}

