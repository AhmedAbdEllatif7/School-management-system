<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGrade extends FormRequest
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
            'List_Grades.*.name_ar' => 'required',
            'List_Grades.*.name_en' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'List_Grades.*.name_ar'  => trans('validation.Please enter the name in english'),
            'List_Grades.*.name_en' => trans('validation.Please enter the name in arabic'),

        ];
    }
}
