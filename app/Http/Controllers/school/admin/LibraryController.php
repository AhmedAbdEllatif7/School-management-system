<?php

namespace App\Http\Controllers\school\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LibraryRequest;
use App\Repositories\Interefaces\LibraryRepositoryInterface;
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


    public function store(LibraryRequest $request)
    {
        return $this->library->store($request);
    }

    public function edit($id)
    {
        return $this->library->edit($id);
    }


    public function update(LibraryRequest $request)
    {
        return $this->library->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->library->delete($request);
    }

    public function downloadBook($filename)
    {
        return $this->library->downloadBook($filename);
    }


    public function viewBook($filename)
    {
        return $this->library->viewBook($filename);
    }
}
