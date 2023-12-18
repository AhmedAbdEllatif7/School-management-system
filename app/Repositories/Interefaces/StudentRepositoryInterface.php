<?php

namespace App\Repositories\Interefaces;

interface StudentRepositoryInterface{


    public function index();

    public function create();

    public function store($request);

    public function edit($student);

    public function update($request);

    public function show($student);

    public function destroy($request);

    public function addPhotoFromDetails($request);

    public function deletePhotoFromDetails($request);

    public function downloadPhoto($studentEmail , $fileName);

    public function openPhoto($studentEmail , $fileName);

    public function getClassrooms($id);

    public function getSections($id);


}


