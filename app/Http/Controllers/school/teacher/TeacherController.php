<?php

namespace App\Http\Controllers\school\teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTeacherRequest;
use App\Repository\TeacherRepositoryInterface;
use App\RepositoryPattern\RepoInterface;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    protected $Teacher;

    public function __construct(TeacherRepositoryInterface $Teacher)
    {
        $this->Teacher = $Teacher;
    }

    public function index()
    {
        $Teachers = $this->Teacher->getAllTeachers();
        return view('pages.Teachers.Teachers',compact('Teachers'));
    }

    public function addTeacher()
    {
        $specializations = $this->Teacher->getSpecialization();
        $genders = $this->Teacher->getGender();
        return view('pages.Teachers.create',compact('specializations','genders'));
    }

    public function storeTeacher(Request $request)
    {
       return $this->Teacher->submitAddTeacher($request);
    }

    public function editTeacherForm(Request $request){

        return $this->Teacher->editTeacherForm($request);
    }


    public function submitEdit(CreateTeacherRequest $request){

        return $this->Teacher->submitEditTeacher($request);
    }

    public function deleteTeacher(Request $request){

        return $this->Teacher->deleteTeacher($request);
    }

    public function viewTeacherData($id){

        return $this->Teacher->viewTeacherData($id);
    }


    public function uploadTeacherFile(Request $request)
    {

        return $this->Teacher->uploadTeacherFile($request);

    }



    public function deleteFileTeacher(Request $request)
    {
        return $this->Teacher->deleteFileTeacher($request);

    }



    public function downloadTeacherFile($teacher_name , $file_name)
    {
        return $this->Teacher->downloadFileTeacher($teacher_name , $file_name);
    }







}
