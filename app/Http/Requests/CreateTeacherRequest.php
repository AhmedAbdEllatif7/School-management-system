<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTeacherRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    { $teacherId = $this->id;
        return [
            'Email' => 'required|email|unique:teachers,email,'.$teacherId,
            'Password' => 'required|min:6',
            'Name_en' => 'required',
            'Name_ar' => 'required',
            'Specialization_id' => 'required',
            'Gender_id' => 'required',
            'Joining_Date' => 'required|date',
            'Address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'Email.required' => trans('Teacher_trans.email.required'),
            'Email.email' => trans('Teacher_trans.email.email'),
            'Email.unique' => trans('Teacher_trans.email.unique'),
            'Password.required' => trans('Teacher_trans.password.required'),
            'Password.min' => trans('Teacher_trans.password.min'),
            'Name_en.required' => trans('Teacher_trans.name_en.required'),
            'Name_ar.required' => trans('Teacher_trans.name_ar.required'),
            'Specialization_id.required' => trans('Teacher_trans.specialization_id.required'),
            'Gender_id.required' => trans('Teacher_trans.gender_id.required'),
            'Joining_Date.required' => trans('Teacher_trans.joining_date.required'),
            'Joining_Date.date' => trans('Teacher_trans.joining_date.date'),
            'Address.required' => trans('Teacher_trans.address.required'),
        ];
    }
}
