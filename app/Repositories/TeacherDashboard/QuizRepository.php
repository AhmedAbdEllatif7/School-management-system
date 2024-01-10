<?php

namespace App\Repositories\TeacherDashboard;

use App\Repositories\Interefaces\TeacherDashboard\QuizRepositoryInterface;
use App\Models\Degree;
use App\Models\Grade;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class QuizRepository implements QuizRepositoryInterface {

    public function index()
    {
        $quizzes = Quiz::where('teacher_id',auth()->user()->id)->select('id', 'name', 'subject_id', 'grade_id', 'classroom_id', 'section_id', 'teacher_id')->get();
        return view('dashboards.teacher.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $grades = Grade::select('id', 'name')->get();
        $subjects = Subject::where('teacher_id',auth()->user()->id)->select('id', 'name')->get();
        
        return view('dashboards.teacher.quizzes.create', compact('grades', 'subjects'));
    }



    public function getStudentThatExammed($quiz_id)
    {
        $degrees = Degree::where('quiz_id', $quiz_id)->get();
        return view('dashboards.teacher.quizzes.examedStudents', compact('degrees'));
    }



    public function repeatExam($request)
    {
        Degree::where('student_id', $request->student_id)->where('quiz_id', $request->quizze_id)->delete();
        return redirect()->back()->with('repeat' , trans('main_trans.exam_reopened'));
    }


    public function store($request)
    {
        try {
            $validatedData = $request->validated();

            $nameFormatted = [
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ];

            unset($validatedData['name_en'], $validatedData['name_ar']);

            $validatedData['name'] = $nameFormatted;
            $validatedData['teacher_id'] = Auth::id();
            Quiz::create($validatedData);

            return redirect()->route('quizzes.create')->with(['add_done' => trans('Students_trans.add_done')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function show($id)
    {
        $questions = Question::where('quizz_id',$id)->get();
        $quizz = Quiz::findorFail($id);
        return view('dashboards.teacher.questions.index',compact('questions','quizz'));
    }

    public function edit($id)
    {
        $quizz = Quiz::findorFail($id);
        $grades = Grade::select('id', 'name')->get();
        $subjects = Subject::where('teacher_id',auth()->user()->id)->select('id', 'name')->get();
        return view('dashboards.teacher.quizzes.edit', compact('quizz', 'grades', 'subjects'));
    }


    public function update($request)
    {
        try {
            $quizz = Quiz::findOrFail($request->id);
            $validatedData = $request->validated();

            $nameFormatted = [
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ];

            unset($validatedData['name_en'], $validatedData['name_ar']);

            $validatedData['name'] = $nameFormatted;
            $validatedData['teacher_id'] = Auth::id();

            $quizz->update($validatedData);

            return redirect()->route('quizzes.index')->with(['edit_done' => trans('Students_trans.edit_done')]);
        } catch (\Exception $e) {
        return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        try {
            $quiz = Quiz::findOrFail($id);
            $quiz->delete();
            return redirect()->back()->with(['delete_done' => trans('Students_trans.delete_done')]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}