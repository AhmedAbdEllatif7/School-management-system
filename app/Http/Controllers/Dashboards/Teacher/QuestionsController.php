<?php

namespace App\Http\Controllers\Dashboards\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionsRequest;
use App\Repositories\Interefaces\TeacherDashboard\QuestionsRepositoryInterface;

class QuestionsController extends Controller
{

    protected $questions;

    public function __construct(QuestionsRepositoryInterface $questions)
    {
        $this->questions = $questions;
    }

    public function store(QuestionsRequest $request)
    {
        return $this->questions->store($request);
    }

    public function show($id)
    {
        return $this->questions->show($id);
    }

    public function edit($id)
    {
        return $this->questions->edit($id);
    }

    public function update(QuestionsRequest $request, $id)
    {
        return $this->questions->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->questions->destroy($id);
    }
}
