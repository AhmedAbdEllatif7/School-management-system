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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:teachers,email,' . request()->id,
            'password' => 'required|min:6',
            'nameEn' => 'required|string',
            'nameAr' => 'required|string',
            'specializationId' => 'required|exists:specializations,id',
            'genderId' => 'required|exists:genders,id',
            'joiningDate' => 'required|date',
            'address' => 'required|string',
        ];
    }
}
