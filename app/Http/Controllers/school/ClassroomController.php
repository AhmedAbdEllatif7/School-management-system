<?php

namespace App\Http\Controllers\school;

use App\Http\Requests\StoreClassroom;
use App\Models\Classroom;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Repository\ClassroomRepository;
use App\Repository\ClassroomRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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


    public function create()
    {
        //
    }

    public function store(StoreClassroom $request)
    {
        return $this->classroom->store($request);

    }



    public function show(Classroom $classroom)
    {
        //
    }


    public function edit(Classroom $classroom)
    {

    }

    public function update(StoreClassroom $request)
    {
        return $this->classroom->update($request);


    }

    public function destroy(Request $request)
    {
        return $this->classroom->destroy($request);

    }


    public function deleteAll(Request $request)
    {
        return $this->classroom->deleteAll($request);

    }


    public function  filterClasses(Request $request)
    {
        return $this->classroom->filterClasses($request);

    }



}

