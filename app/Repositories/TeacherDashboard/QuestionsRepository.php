<?php

namespace App\Repositories\TeacherDashboard;

use App\Repositories\Interefaces\TeacherDashboard\QuestionsRepositoryInterface;
use App\Models\Question;
class QuestionsRepository implements QuestionsRepositoryInterface {

    public function store($request)
    {
        try {
            $validatedData = $request->validated();
            Question::create($validatedData);
            return redirect()->back()->with(['add_done' => trans('Students_trans.add_done')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function show($id)
    {
        $quizz_id = $id;
        return view('dashboards.teacher.questions.create', compact('quizz_id'));
    }


    public function edit($id)
    {
        $question = Question::findorFail($id);
        $quizz_id = $question->quizz_id;
        return view('dashboards.teacher.questions.edit', compact('question', 'quizz_id'));
    }


    public function update($request, $id)
    {
        try {
            $validatedData = $request->validated();

            $question = Question::findorfail($request->id);
            $question->update($validatedData);

            return redirect()->back()->with(['edit_done' => trans('Students_trans.edit_done')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        try {
            Question::destroy($id);
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}