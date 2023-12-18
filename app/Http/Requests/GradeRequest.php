<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GradeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'listOfGrades.*.name_ar' => 'required',
            'listOfGrades.*.name_en' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'listOfGrades.*.name_ar'  => trans('grade_trans.missing_name_ar'),
            'listOfGrades.*.name_en' => trans('grade_trans.missing_name_en'),

        ];
    }
}
