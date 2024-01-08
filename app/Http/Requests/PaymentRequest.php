<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'student_id' => [
                'required',
                'integer',
                Rule::exists('students', 'id')->where(function ($query) {
                    $query->where('id', request()->student_id);
                }),
            ],
            'Debit' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ];
    }


    public function messages()
    {
        return [
            'student_id.required' => trans('main_trans.student_id.required'),
            'student_id.integer' => trans('main_trans.student_id.integer'),
            'student_id.exists' => trans('main_trans.student_id.exists'),
            'Debit.required' => trans('main_trans.Debit.required'),
            'Debit.numeric' => trans('main_trans.Debit.numeric'),
            'Debit.min' => trans('main_trans.Debit.min', ['min' => 0]),
            'description.required' => trans('main_trans.description.required'),
            'description.string' => trans('main_trans.description.string'),
        ];
    }
}
