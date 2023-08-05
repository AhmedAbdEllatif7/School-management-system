<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeesRequest extends FormRequest
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
            'title_en' => 'required',
            'title_ar' => 'required',
            'amount' => 'required|numeric',
            'Grade_id' => 'required|exists:grades,id',
            'Classroom_id' => 'required|exists:classrooms,id',
            'description' => 'nullable',
            'year' => 'required|numeric',
        ];

    }

    public function messages()
    {
        return [
            'title_en.required' => __('students_trans.title_en_required'),
            'title_ar.required' => __('students_trans.title_ar_required'),
            'amount.required' => __('students_trans.amount_required'),
            'amount.numeric' => __('students_trans.amount_numeric'),
            'Grade_id.required' => __('students_trans.grade_id_required'),
            'Grade_id.exists' => __('students_trans.grade_id_exists'),
            'Classroom_id.required' => __('students_trans.classroom_id_required'),
            'Classroom_id.exists' => __('students_trans.classroom_id_exists'),
            'description.nullable' => __('students_trans.description_nullable'),
            'year.required' => __('students_trans.year_required'),
            'year.numeric' => __('students_trans.year_numeric'),
        ];
    }
}
