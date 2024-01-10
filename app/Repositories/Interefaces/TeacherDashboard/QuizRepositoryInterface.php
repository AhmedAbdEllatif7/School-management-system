<?php

namespace app\Repositories\Interefaces\TeacherDashboard;

interface QuizRepositoryInterface {

    public function index();

    public function create();

    public function getStudentThatExammed($quiz_id);

    public function repeatExam($request);

    public function store($request);

    public function show($id);

    public function edit($id);

    public function update($request);

    public function destroy($id);

}