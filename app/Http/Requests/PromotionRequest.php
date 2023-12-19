<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromotionRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'from_grade_id' => 'required',
            'from_classroom_id' => 'required',
            'from_section_id' => 'required',
            'from_academic_year' => 'required',
            'to_grade_id' => 'required',
            'to_classroom_id' => 'required',
            'to_section_id' => 'required',
            'to_academic_year' => 'required',
        ];
    }

    
}
