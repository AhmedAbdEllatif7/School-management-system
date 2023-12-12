<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
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
            'name_ar' => 'required',
            'name_en' => 'required',
            'class_id' => 'required',
            'grade_id' => 'required',
        ];
    }


    public function messages(): array
    {
        return [
            'name_ar.required'  => trans('sections_trans.required_ar'),
            'name_en.required'  => trans('sections_trans.required_en'),
            'class_id.required'  => trans('sections_trans.Class_id_required'),
            'grade_id.required'  => trans('sections_trans.Grade_id_required'),

        ];
    }
}
