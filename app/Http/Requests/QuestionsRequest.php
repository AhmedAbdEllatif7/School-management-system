<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionsRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'answers' => 'required', 
            'right_answer' => 'required',
            'score' => 'required|numeric', 
            'quizz_id' => 'required|exists:quizzes,id',
        ];
    }
}
