<?php

namespace App\Http\Controllers\school\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSection;
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



    public function create()
    {
        //
    }


    public function store(StoreSection $request)
    {
        return $this->section->store($request);

    }


    public function show(Section $section)
    {
        //
    }



    public function edit(Section $section)
    {
        //
    }


    public function update(StoreSection $request)
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
