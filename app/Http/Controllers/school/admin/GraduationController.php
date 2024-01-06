<?php

namespace App\Http\Controllers\school\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GraduationRequest;
use App\Repositories\Interefaces\GraduationRepositoryInterface;
use Illuminate\Http\Request;

class GraduationController extends Controller
{

    protected $graduation;

    public function __construct(GraduationRepositoryInterface $graduation)
    {
        $this->graduation = $graduation;
    }

    public function index()
    {
        return $this->graduation->index();
    }

    public function create()
    {
        return $this->graduation->create();
    }

    public function store(GraduationRequest $request)
    {
        return $this->graduation->store($request);
    }

    public function restored(Request $request)
    {
        return $this->graduation->restored($request);
    }

    public function destroy(Request $request)
    {
        return $this->graduation->forceDeleteSelected($request);
    }


    public function graduatedSelected(Request $request)
    {
        return $this->graduation->graduateSelected($request);

    }



}
