<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceiptRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'debit' => 'required|numeric|max:99999',
            'description' => 'required',
            'student_id' => 'required',
        ];
    }
}
