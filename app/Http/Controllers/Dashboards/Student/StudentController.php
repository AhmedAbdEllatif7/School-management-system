<?php

namespace App\Http\Controllers\Dashboards\Student;

use App\Http\Controllers\Controller;

use App\Repositories\Interefaces\StudentDashboard\StudentRepositoryInterface;

class StudentController extends Controller
{
    protected $studentDashboard;

    public function __construct(StudentRepositoryInterface $studentDashboard)
    {
        $this->studentDashboard = $studentDashboard;
    }


    public function index()
    {
        return $this->studentDashboard->index();
    }


    public function getExams()
    {
        return $this->studentDashboard->getExams();
    }


    public function getQuestions($quiz_id)
    {
        return $this->studentDashboard->getQuestions($quiz_id);
    }

}
