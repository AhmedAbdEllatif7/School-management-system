<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nameEn' => 'required|string|max:255',
            'nameAr' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,' . request()->id,
            'password' => 'required|min:6',
            'specialization_id' => 'required|exists:specializations,id',
            'gender_id' => 'required|exists:genders,id',
            'joining_date' => 'required|date',
            'address' => 'required|string',
        ];
    }
    
}
