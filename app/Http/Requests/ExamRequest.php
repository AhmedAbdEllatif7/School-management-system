<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
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
            'Name_en' => 'required|string|max:255',
            'Name_ar' => 'required|string|max:255',
            'term' => 'required|string|max:255',
            'academic_year' => 'required|integer',
        ];
    }


    public function messages()
    {
        return [
            'Name_en.required' => trans('Students_trans.name_en_required'),
            'Name_ar.required' => trans('Students_trans.name_ar_required'),
            'term.required' => trans('Students_trans.term_required'),
            'academic_year.required' => trans('Students_trans.academic_year_required'),
            'academic_year.integer' => trans('Students_trans.academic_year_integer'),
        ];
    }
}
