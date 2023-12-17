<?php

namespace App\Http\Controllers\school\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use App\Models\Teacher;
use App\Repositories\Interefaces\TeacherRepositoryInterface;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    protected $teacher;

    public function __construct(TeacherRepositoryInterface $teacher)
    {
        $this->teacher = $teacher;
    }



    public function index()
    {
        return $this->teacher->index();
    }



    public function create()
    {
        return $this->teacher->create();
    }



    public function store(TeacherRequest $request)
    {
        return $this->teacher->store($request);
    }



    public function edit(Teacher $teacher)
    {
        return $this->teacher->edit($teacher);
    }



    public function update(TeacherRequest $request , Teacher $teacher)
    {
        return $this->teacher->update($request , $teacher);
    }



    public function destroy(Teacher $teacher)
    {
        return $this->teacher->destroy($teacher);
    }



    public function show($id){
        return $this->teacher->show($id);
    }



    public function uploadTeacherPhoto(Request $request) 
    {
        return $this->teacher->uploadTeacherPhoto($request);
    }



    public function deleteTeacherPhoto(Request $request)
    {
        return $this->teacher->deleteTeacherPhoto($request);
    }


    public function downloadTeacherPhoto($teacher_name , $file_name)
    {
        return $this->teacher->downloadTeacherPhoto($teacher_name , $file_name);
    }







}
