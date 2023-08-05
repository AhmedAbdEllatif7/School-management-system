<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSection extends FormRequest
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
            'Class_id' => 'required',
            'Grade_id' => 'required',
        ];
    }


    public function messages(): array
    {
        return [
            'name_ar.required'  => trans('validation.Please enter the name in arabic'),
            'name_en.required'  => trans('validation.Please enter the name in english'),
            'Class_id.required'  => trans('validation.Please choose the class name'),
            'Grade_id.required'  => trans('validation.Please choose the grade name'),

        ];
    }
}
