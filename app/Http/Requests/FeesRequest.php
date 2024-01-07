<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeesRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'title_en' => 'required|max:255',
            'title_ar' => 'required|max:255',
            'amount' => 'required|numeric|max:999999.99', 
            'grade_id' => 'required|exists:grades,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'description' => 'nullable|max:500', 
            'year' => 'required|numeric|max:9999', 
            'fee_type' => 'required',
            
        ];

    }

}
