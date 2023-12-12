<?php

namespace App\Repository;

interface StudentRepositoryInterface{


    // Get Add Form Student
    public function Create_Student();

    // Get classrooms
    public function getClassrooms($id);

    //Get Sections
    public function getSections($id);

    public function getNewClassroom($id);

    public function getNewSection($id);

    //Store_Student
    public function storeStudent($request);

    public function editForm($id);

    public function showStudent($id);

    public function updateStudent($request);

    public function deleteStudent($request);

    public function uploadAttachments($request);

    public function downloadAttachments($studentName , $fileName);

    public function deleteAttachment($request);


    public function viewFile($studentName , $fileName);




}


