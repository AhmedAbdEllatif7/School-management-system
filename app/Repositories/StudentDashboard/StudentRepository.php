<?php

namespace App\Repositories\StudentDashboard;

use App\Repositories\Interefaces\StudentDashboard\StudentRepositoryInterface;
use App\Models\Student;
use App\Models\Quiz;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class StudentRepository implements StudentRepositoryInterface 
{
    public function index()
    {
        $student = Student::where('id' , Auth::user()->id)->first();
        $subjects = Subject::where('grade_id' , $student->grade_id)->where('classroom_id' , $student->classroom_id)->get();
        return view('dashboards.student.dashboard' , compact('subjects' , 'student'));
    }


    public function getExams()
    {
        $quizzes = Quiz::where('grade_id', auth()->user()->grade_id)
            ->where('classroom_id', auth()->user()->classroom_id)
            ->where('section_id', auth()->user()->section_id)
            ->get();
        return view('dashboards.student.exams', compact('quizzes'));
    }


    public function getQuestions($quiz_id)
    {
        $student_id = Auth::user()->id;
        return view('dashboards.student.questions' , compact('student_id', 'quiz_id'));
    }
}