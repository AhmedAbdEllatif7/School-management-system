<?php

namespace App\Repositories\AdminDashboard;

use App\Models\Fee;
use App\Models\Grade;
use App\Repositories\Interefaces\AdminDashboard\FeesRepositoryInterface;

class FeesRepository implements FeesRepositoryInterface
{
    public function index()
    {
        $fees = Fee::select('title', 'id', 'amount', 'grade_id', 'classroom_id', 'description', 'year')->get();
        return view('dashboards.admin.fees.index' , compact('fees'));
    }


    public function create()
    {
        $grades = Grade::select('id', 'name')->get();
        return view('dashboards.admin.fees.create' , compact('grades'));
    }


    public function store($request)
    {     
        $validatedData = $request->validated();
    
        $formattedData = $this->formatData($validatedData);
    
        Fee::create($formattedData);
    
        return redirect()->back()->with(['store_fees' => 'fees_stored']);
    }
    
    private function formatData(array $data)
    {
        $formattedTitle = [
            'en' => $data['title_en'],
            'ar' => $data['title_ar']
        ];
    
        unset($data['title_en'], $data['title_ar']);
    
        $data['title'] = $formattedTitle;
    
        return $data;
    }
    
    
    
    public function edit($fee)
    {
        $grades = Grade::select('id', 'name')->get();
        return view('dashboards.admin.fees.edit' , compact(['grades' , 'fee']));
    }



    public function update($request)
    {
        $validatedData = $request->validated();
    
        $formattedData = $this->formatUpdateData($validatedData);
    
        $fees = Fee::findOrFail($request->id);
        $fees->update($formattedData);
    
        return redirect()->route('fees.index')->with(['update_fees' => 'Fees updated successfully']);
    }
    
    private function formatUpdateData(array $data)
    {
        $formattedTitle = [
            'en' => $data['title_en'],
            'ar' => $data['title_ar']
        ];
    
        unset($data['title_en'], $data['title_ar']);
    
        $data['title'] = $formattedTitle;
    
        return $data;
    }
    

    public function delete($request)
    {
        Fee::findOrFail($request->id)->delete();
        return redirect()->route('fees.index')->with(['delete_fees' => 'Fees deleted successfully']);

    }



}

