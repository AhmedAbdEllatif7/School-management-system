<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
        $studentId = request()->id;
        return [
            'nameEn' => 'required|string|max:255',
            'nameAr' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,'.$studentId,
            'password' => 'required|min:6',
            'gender_id' => 'required|exists:genders,id',
            'nationalitie_id' => 'required|exists:nationalities,id',
            'blood_id' => 'required|exists:bloods,id',
            'date_birth' => 'required|date',
            'grade_id' => 'required|exists:grades,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'section_id' => 'required|exists:sections,id',
            'parent_id' => 'required|exists:parents,id',
            'academic_year' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'required' => trans('Students_trans.required'),
            'email' => trans('Students_trans.email2'),
            'unique' => trans('Students_trans.unique'),
            'min' => [
                'string' => trans('Students_trans.min.string', ['min' => ':min']),
                'numeric' => trans('Students_trans.min.numeric', ['min' => ':min']),
            ],
            'exists' => trans('Students_trans.exists'),
            'date' => trans('Students_trans.date'),
            'max' => [
                'string' => trans('Students_trans.max.string', ['max' => ':max']),
            ],
        ];
    }

}
