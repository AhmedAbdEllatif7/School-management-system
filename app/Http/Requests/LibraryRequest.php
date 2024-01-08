<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LibraryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string',
            'grade_id' => 'required|exists:grades,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'section_id' => 'required|exists:sections,id',
            'file_name' => 'required|mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => trans('validation.required', ['attribute' => trans('main_trans.book_name')]),
            'grade_id.required' => trans('validation.required', ['attribute' => trans('Students_trans.Grade')]),
            'grade_id.exists' => trans('validation.exists', ['attribute' => trans('Students_trans.Grade')]),
            'classroom_id.required' => trans('validation.required', ['attribute' => trans('Students_trans.classrooms')]),
            'classroom_id.exists' => trans('validation.exists', ['attribute' => trans('Students_trans.classrooms')]),
            'section_id.exists' => trans('validation.exists', ['attribute' => trans('Students_trans.section')]),
            'file_name.required' => trans('validation.required', ['attribute' => trans('main_trans.attachments')]),
            'file_name.mimes' => trans('validation.mimes', ['attribute' => trans('main_trans.attachments'), 'values' => 'PDF']),
        ];
    }
}
