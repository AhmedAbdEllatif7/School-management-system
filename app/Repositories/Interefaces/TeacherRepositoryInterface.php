<?php

namespace App\Repositories\Interefaces;

interface TeacherRepositoryInterface{

    // get all Teachers
    public function getAllTeachers();

    public function getSpecialization();

    public function getGender();

    public function editTeacherForm($request);

    public function submitAddTeacher($request);

    public function submitEditTeacher($request);

    public function deleteTeacher($request);

    public function viewTeacherData($id);

     public function uploadTeacherFile($request);

    public function deleteFileTeacher($request);

    public function downloadFileTeacher($teacher_name , $file_name);

}


