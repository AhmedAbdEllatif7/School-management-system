<?php

namespace App\Http\Controllers\school\admin;

use App\Http\Controllers\Controller;
use App\Repository\LibraryRepositoryInterface;
use Illuminate\Http\Request;

class LibraryController extends Controller
{



    protected $library;
    public function __construct(LibraryRepositoryInterface $library)
    {
        $this->library = $library;
    }

    public function index()
    {
        return $this->library->index();
    }


    public function create()
    {
        return $this->library->create();

    }


    public function store(Request $request)
    {
        return $this->library->store($request);

    }



    public function show($id)
    {

    }


    public function edit($id)
    {
        return $this->library->edit($id);

    }


    public function update(Request $request)
    {
        return $this->library->update($request);

    }


    public function destroy(Request $request)
    {
        return $this->library->delete($request);

    }

    public function downloadFile($filename)
    {
        return $this->library->download($filename);

    }


    public function viewFile($filename)
    {
        return $this->library->viewFile($filename);

    }
}
