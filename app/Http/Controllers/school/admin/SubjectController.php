<?php

namespace App\Http\Controllers\school\admin;

use App\Http\Controllers\Controller;
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

    public function store(Request $request)
    {
        return $this->subject->store($request);

    }

    /**
     * Display the specified resource.
     */
    // public function show(Subject $subject)
    // {
    //     return $this->subject->show();

    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->subject->edit($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->subject->update($request);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->subject->destroy($request);

    }
}
