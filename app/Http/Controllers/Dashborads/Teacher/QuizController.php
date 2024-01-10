<?php

namespace App\Http\Controllers\Dashborads\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuizRequest;
use App\Repositories\Interefaces\TeacherDashboard\QuizRepositoryInterface;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    protected $quiz;

    public function __construct(QuizRepositoryInterface $quiz)
    {
        $this->quiz = $quiz;
    }

    public function index()
    {
        
        return $this->quiz->index();
    }

    public function create()
    {
        return $this->quiz->create();
    }

    public function getStudentThatExammed($quiz_id)
    {
        return $this->quiz->getStudentThatExammed($quiz_id);
    }

    public function repeatExam(Request $request)
    {
        return $this->quiz->repeatExam($request);
    }

    public function store(QuizRequest $request)
    {
        return $this->quiz->store($request);
    }

    public function show($id)
    {
        return $this->quiz->show($id);
    }

    public function edit($id)
    {
        return $this->quiz->edit($id);
    }

    public function update(QuizRequest $request)
    {
        return $this->quiz->update($request);
    }

    public function destroy($id)
    {
        return $this->quiz->destroy($id);
    }
    

}
