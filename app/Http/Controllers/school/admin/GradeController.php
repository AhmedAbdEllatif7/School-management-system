<?php

namespace App\Http\Controllers\school\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GradeRequest;
use App\Repository\GradeRepositoryInterface;
use Illuminate\Http\Request;

class GradeController extends Controller
{

    protected $grade;
    
    public function __construct(GradeRepositoryInterface $grade)
    {
        $this->grade = $grade;
    }


    public function index()
    {
        return $this->grade->index();
    }


    public function create()
    {

    }


    public function store(GradeRequest $request)
    {
        return $this->grade->store($request);
    }

    public function show($id)
    {

    }


    public function edit(Request $request)
    {
        return "cc";
    }


    public function update(GradeRequest $request)
    {
        return $this->grade->update($request);

    }



    public function destroy(Request $request)
    {
        return $this->grade->delete($request);

    }



    // public function deleteSelected(Request $request)
    // {
    //     return $this->grade->deleteSelected($request);

    // }


    public function deleteSelectedGrade(Request $request)
    {
        return $this->grade->deleteSelectedGrade($request);

    }








}

?>
