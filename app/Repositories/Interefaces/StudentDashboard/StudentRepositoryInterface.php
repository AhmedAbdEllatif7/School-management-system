<?php

namespace App\Repositories\Interefaces\StudentDashboard;

interface StudentRepositoryInterface
{

    public function index();

    public function getExams();

    public function getQuestions($quiz_id);

}