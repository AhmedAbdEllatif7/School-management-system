<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassroomRequest extends FormRequest
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
            'List_Classes.*.name_ar' => 'required',
            'List_Classes.*.name_en' => 'required',
            'List_Classes.*.grade_id' => 'required',

        ];
    }

    public function messages()
    {
        return [
                'List_Classes.*.name_ar.required' => trans('validation.Please enter the name in arabic'),
                'List_Classes.*.name_en.required' => trans('validation.Please enter the name in english'),
                'List_Classes.*.grade_id.required' => trans('validation.Please enter the grade_id'),
                'name_ar.required' => trans('validation.Please enter the name in arabic'),
                'name_en.required' => trans('validation.Please enter the name in english'),
        ];
    }
}
