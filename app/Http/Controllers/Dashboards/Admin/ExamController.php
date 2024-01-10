<?php

namespace App\Http\Controllers\Dashboards\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{

    public function index()
    {
        $quizzes = Quiz::where('grade_id', auth()->user()->grade_id)
            ->where('classroom_id', auth()->user()->classroom_id)
            ->where('section_id', auth()->user()->section_id)
            ->get();
        return view('pages.Students.exam', compact('quizzes'));
    }



    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show($quiz_id)
    {
        $student_id = Auth::user()->id;
        return view('pages.Students.show_questions' , compact('student_id', 'quiz_id'));
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
