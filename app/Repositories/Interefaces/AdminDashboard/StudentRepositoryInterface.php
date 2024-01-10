<?php

namespace app\Repositories\Interefaces\AdminDashboard;

interface StudentRepositoryInterface{


    public function index();

    public function create();

    public function store($request);

    public function edit($student);

    public function update($request);

    public function show($student);

    public function forceDeleted($request);

    public function addPhotoFromDetails($request);

    public function deletePhotoFromDetails($request);

    public function downloadPhoto($studentEmail , $fileName);

    public function openPhoto($studentEmail , $fileName);

    public function getClassrooms($id);

    public function getSections($id);


}


