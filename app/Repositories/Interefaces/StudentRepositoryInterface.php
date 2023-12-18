<?php

namespace App\Repositories\Interefaces;

interface StudentRepositoryInterface{


    public function index();

    public function create();

    public function store($request);

    public function edit($student);

    public function update($request);

    public function showStudent($id);

    public function destroy($request);

    public function uploadAttachments($request);

    public function downloadAttachments($studentName , $fileName);

    public function deleteAttachment($request);

    public function viewFile($studentName , $fileName);

    public function getClassrooms($id);

    public function getSections($id);


}


