<?php

namespace App\Http\Controllers\school\parent;

use App\Http\Controllers\Controller;
use App\Repository\ParentStudentRepositoryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    protected $parentStudent;
    public function __construct(ParentStudentRepositoryInterface $parentStudent)
    {
        $this->parentStudent = $parentStudent;
    }
    public function index()
    {
        return $this->parentStudent->index();
    }

    public function filterAttendances(Request $request)
    {
        return $this->parentStudent->filterAttendances($request);

    }

    public function fees()
    {
        return $this->parentStudent->fees();

    }


    public function receiptStudent($id)
    {

        return $this->parentStudent->receiptStudent($id);

    }


    public function profile()
    {
        return $this->parentStudent->profile();

    }

    public function update(Request $request, $id)
    {

        return $this->parentStudent->update($request , $id);


    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        return $this->parentStudent->show($id);

    }

    public function getAttendance()
    {
        return $this->parentStudent->getAttendance();

    }


    public function edit(string $id)
    {
        //
    }




    public function destroy(string $id)
    {
        //
    }
}
