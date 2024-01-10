<?php

namespace app\Repositories\Interefaces\AdminDashboard;

interface TeacherRepositoryInterface{

    // get all Teachers
    public function index();

    public function create();

    public function edit($teacher);

    public function store($request);

    public function update($request , $teacher);

    public function destroy($teacher);

    public function show($id);

    public function addPhotoFromDetails($request);

    public function openPhoto($teacherEmail , $fileName);

    public function deletePhotoFromDetails($request);

    public function downloadPhoto($teacherEmail , $fileName);

}


