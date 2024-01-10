<?php

namespace App\Http\Controllers\Dashborads\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GradeRequest;
use App\Repositories\Interefaces\GradeRepositoryInterface;
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


    public function store(GradeRequest $request)
    {
        return $this->grade->store($request);
    }



    public function update(GradeRequest $request)
    {
        return $this->grade->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->grade->delete($request);
    }



    public function deleteSelectedGrades(Request $request)
    {
        return $this->grade->deleteSelectedGrades($request);
    }








}

?>
