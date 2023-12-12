<?php

namespace App\Http\Controllers\school\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\Models\Section;
use App\Repositories\Interefaces\SectionRepositoryInterface;
use Illuminate\Http\Request;

class SectionController extends Controller
{

    protected $section;
    public function __construct(SectionRepositoryInterface $section)
    {
        $this->section = $section;
    }
    public function index()
    {
        return $this->section->index();
    }



    public function store(SectionRequest $request)
    {
        return $this->section->store($request);

    }


    public function update(SectionRequest $request)
    {
        return $this->section->update($request);

    }


    public function destroy(Request $request)
    {
        return $this->section->destroy($request);

    }


    public function getClases($id)
    {
        return $this->section->getClases($id);
    }
}
