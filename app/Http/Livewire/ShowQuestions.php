<?php

namespace App\Http\Livewire;

use App\Models\Degree;
use App\Models\Question;
use Livewire\Component;

class ShowQuestions extends Component
{
    public $quizze_id, $student_id, $data, $counter = 0, $questioncount = 0;

    public function render()
    {
        $this->data = Question::where('quizz_id', $this->quizze_id)->get();
        $this->questioncount = $this->data->count();
        return view('livewire.studentDashboard.show-questions', ['data']);
    }

    public function nextQuestion($question_id, $score, $answer, $right_answer)
    {
        $degreeStatus = $this->getStudentDegree();

        if ($degreeStatus === null) {
            $this->insertDegree($question_id, $score, $answer, $right_answer);
        } else {
            $this->updateDegree($degreeStatus, $question_id, $score, $answer, $right_answer);
        }

        $this->updateQuizProgress();
    }

    private function getStudentDegree()
    {
        return Degree::where('student_id', $this->student_id)
            ->where('quiz_id', $this->quizze_id)
            ->first();
    }

    private function insertDegree($question_id, $score, $answer, $right_answer)
    {
        $degree = new Degree();
        $degree->quiz_id = $this->quizze_id;
        $degree->student_id = $this->student_id;
        $degree->question_id = $question_id;
        $degree->score = (strcmp(trim($answer), trim($right_answer)) === 0) ? $score : 0;
        $degree->date = date('Y-m-d');
        $degree->save();
    }

    private function updateDegree($degreeStatus, $question_id, $score, $answer, $right_answer)
    {
        if ($degreeStatus->question_id >= $this->data[$this->counter]->id) {
            $this->cancelTest($degreeStatus);
        } else {
            $degreeStatus->question_id = $question_id;
            $degreeStatus->score += (strcmp(trim($answer), trim($right_answer)) === 0) ? $score : 0;
            $degreeStatus->save();
        }
    }

    private function cancelTest($degreeStatus)
    {
        $degreeStatus->score = 0;
        $degreeStatus->abuse = '1';
        $degreeStatus->save();
        return redirect()->route('student.exams.show')->with('test_cancelled', trans('main_trans.test_cancelled'));
    }

    private function updateQuizProgress()
    {
        if ($this->counter < $this->questioncount - 1) {
            $this->counter++;
        } else {
            return redirect()->route('student.exams.show')->with('exam_done', trans('main_trans.exam_done'));
        }
    }

}