<?php

namespace App\Http\Controllers\school\teacher;

use App\Http\Controllers\Controller;
use App\Models\Degree;
use App\Models\Grade;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{

    public function index()
    {
        $quizzes = Quiz::where('teacher_id',auth()->user()->id)->get();
        return view('pages.Teachers.Quizzes.index', compact('quizzes'));    }

    public function create()
    {
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::where('teacher_id',auth()->user()->id)->get();
        return view('pages.Teachers.Quizzes.create', $data);
    }



    public function getStudentThatExammed($quiz_id)
    {
        $degrees = Degree::where('quiz_id', $quiz_id)->get();
        return view('pages.Teachers.Quizzes.student_quizze', compact('degrees'));
    }



    public function repeatExam(Request $request)
    {
        Degree::where('student_id', $request->student_id)->where('quiz_id', $request->quizze_id)->delete();
        return redirect()->back()->with('repeat' , trans('main_trans.exam_reopened'));
    }


    public function store(Request $request)
    {
        try {
            $data = [
                'name' => ['en' => $request->Name_en, 'ar' => $request->Name_ar],
                'subject_id' => $request->subject_id,
                'grade_id' => $request->Grade_id,
                'classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'teacher_id' => Auth::user()->id,
            ];

            $quiz = Quiz::create($data);

            return redirect()->route('quizzes-teacher.create')->with(['add_done' => trans('Students_trans.add_done')]);
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $questions = Question::where('quizze_id',$id)->get();
        $quizz = Quiz::findorFail($id);
        return view('pages.Teachers.Questions.index',compact('questions','quizz'));
    }

    public function edit($id)
    {
        $quizz = Quiz::findorFail($id);
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::where('teacher_id',auth()->user()->id)->get();
        return view('pages.Teachers.Quizzes.edit', $data, compact('quizz'));
    }


    public function update(Request $request)
    {
        try {
            $quizz = Quiz::findorFail($request->id);
            $quizz->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizz->subject_id = $request->subject_id;
            $quizz->grade_id = $request->Grade_id;
            $quizz->classroom_id = $request->Classroom_id;
            $quizz->section_id = $request->section_id;
            $quizz->teacher_id = auth()->user()->id;
            $quizz->save();
            return redirect()->route('quizzes-teacher.index')->with(['edit_done' => trans('Students_trans.edit_done')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        try {
            Quiz::destroy($id);
            return redirect()->back()->with(['delete_done' => trans('Students_trans.delete_done')]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
