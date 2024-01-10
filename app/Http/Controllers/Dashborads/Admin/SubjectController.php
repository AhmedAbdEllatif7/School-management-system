<?php

namespace App\Http\Controllers\Dashborads\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Models\Subject;
use App\Repositories\Interefaces\SubjectRepositoryInterface;
use Illuminate\Http\Request;


class SubjectController extends Controller
{


    protected $subject;

    public function __construct(SubjectRepositoryInterface $subject)
    {
        $this->subject = $subject;
    }
    public function index()
    {
        return $this->subject->index();
    }


    public function create()
    {
        return $this->subject->create();

    }

    public function store(SubjectRequest $request)
    {
        return $this->subject->store($request);

    }


    public function edit($id)
    {
        return $this->subject->edit($id);

    }

    public function update(SubjectRequest $request)
    {
        return $this->subject->update($request);

    }

    public function destroy(Request $request)
    {
        return $this->subject->destroy($request);

    }
}
