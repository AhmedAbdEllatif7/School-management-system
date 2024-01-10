<?php

namespace App\Http\Controllers\Dashborads\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\Student;
use App\Repositories\Interefaces\StudentRepositoryInterface;
use Illuminate\Http\Request;


class StudentController extends Controller
{

    protected $student;
    public function __construct(StudentRepositoryInterface $student)
    {
        $this->student = $student;
    }

    public function index()
    {
        return $this->student->index();
    }


    public function create()
    {
        return $this->student->create();
    }


    public function store(StudentRequest $request)
    {
        return $this->student->store($request);
    }


    public function edit(Student $student)
    {
        return $this->student->edit($student);
    }


    public function update(StudentRequest $request)
    {
        return $this->student->update($request);
    }


    public function show(Student $student)
    {
        return$this->student->show($student);
    }


    public function destroy(Request $request)
    {
        return $this->student->forceDeleted($request);
    }


    public function addPhotoFromDetails(Request $request) 
    {
        return $this->student->addPhotoFromDetails($request);
    }


    public function deletePhotoFromDetails(Request $request)
    {
        return $this->student->deletePhotoFromDetails($request);
    }


    public function downloadPhoto($studentEmail , $fileName){
        return $this->student->downloadPhoto($studentEmail , $fileName);
    }



    public function openPhoto($studentEmail , $fileName)
    {
        return $this->student->openPhoto($studentEmail , $fileName);
    }


    //for ajax
    public function getClassrooms($id)
    {
        return $this->student->getClassrooms($id);
    }

    public function getSections($id) {
        return $this->student->getSections($id);
    }
}
