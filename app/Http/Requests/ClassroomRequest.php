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
            'listOfClasses.*.name_ar' => 'required',
            'listOfClasses.*.name_en' => 'required',
            'listOfClasses.*.grade_id' => 'required',

        ];
    }

    public function messages()
    {
        return [
                'listOfClasses.*.name_ar.required' => trans('classes_trans.class_name_ar_required'),
                'listOfClasses.*.name_en.required' => trans('classes_trans.class_name_en_required'),
                'listOfClasses.*.grade_id.required' => trans('classes_trans.grade_id_required'),
        ];
    }
}
