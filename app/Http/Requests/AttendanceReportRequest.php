<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceReportRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'from' => 'required|date|date_format:Y-m-d',
            'to'   => 'required|date|date_format:Y-m-d|after_or_equal:from',
        ];
    }
}
