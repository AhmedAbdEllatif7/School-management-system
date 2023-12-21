<?php

namespace App\Http\Controllers\school\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GraduationRequest;
use App\Repositories\Interefaces\GraduationRepositoryInterface;
use Illuminate\Http\Request;

class GraduationController extends Controller
{

    protected $Graduation;

    public function __construct(GraduationRepositoryInterface $Graduation)
    {
        $this->Graduation = $Graduation;
    }

    public function index()
    {
        return $this->Graduation->index();
    }


    public function create()
    {
        return $this->Graduation->create();
    }

    public function store(GraduationRequest $request)
    {
        return $this->Graduation->store($request);
    }


    public function returnAllGraduatedBack(Request $request)
    {
        return $this->Graduation->returnAllGraduatedBack();
    }

    public function returnStudent(Request $request)
    {
        return $this->Graduation->returnStudent($request);
    }

    public function ForceDelete(Request $request)
    {
        return $this->Graduation->forceDelete($request);
    }


    public function graduatedSelected(Request $request)
    {
        return $this->Graduation->graduateSelectes($request);

    }

}
