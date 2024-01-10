<?php

namespace app\Repositories\Interefaces\TeacherDashboard;

interface QuestionsRepositoryInterface {

    public function store($request);

    public function show($id);

    public function edit($id);

    public function update($request, $id);

    public function destroy($id);

}