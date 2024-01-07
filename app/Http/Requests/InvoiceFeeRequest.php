<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceFeeRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'listOfFees.*.student_id' => 'required|exists:students,id',
            'listOfFees.*.fee_id' => 'required|exists:fees,id',
            'listOfFees.*.amount' => 'required|numeric',
            'listOfFees.*.description' => 'required|max:255',
            'listOfFees.*.grade_id' => 'required', // Adjust this as per your validation rules
            'listOfFees.*.classroom_id' => 'required', // Adju
        ];
    }
}
