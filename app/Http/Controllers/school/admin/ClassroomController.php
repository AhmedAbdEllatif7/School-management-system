<?php

namespace App\Http\Controllers\school\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomRequest;
use App\Repository\ClassroomRepositoryInterface;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{

    protected $classroom;

    public function __construct(ClassroomRepositoryInterface $classroom)
    {
        $this->classroom = $classroom;
    }



    public function index()
    {
        return $this->classroom->index();
    }



    public function store(ClassroomRequest $request)
    {
        return $this->classroom->store($request);
    }



    public function update(ClassroomRequest $request)
    {
        return $this->classroom->update($request);
    }



    public function destroy(Request $request)
    {
        return $this->classroom->destroy($request);
    }



    public function deleteSelectedClassrooms(Request $request)
    {
        return $this->classroom->deleteSelectedClassrooms($request);
    }



    public function  filterClasses(Request $request)
    {
        return $this->classroom->filterClasses($request);
    }



}

