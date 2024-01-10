<?php

namespace App\Http\Controllers\Dashborads\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interefaces\QuizRepositoryInterface;
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

    public function store(Request $request)
    {
        return $this->quiz->store($request);

    }


    public function show($id)
    {
    }

    public function edit($id)
    {
        return $this->quiz->edit($id);

    }


    public function update(Request $request)
    {
        return $this->quiz->update($request);

    }


    public function delete(Request $request)
    {
        return $this->quiz->delete($request);

    }
}
