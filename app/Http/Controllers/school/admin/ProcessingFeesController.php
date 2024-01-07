<?php

namespace App\Http\Controllers\school\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProcessingFeesRequest;
use App\Repositories\Interefaces\ProcessingFeesRepositoryInterface;
use Illuminate\Http\Request;

class ProcessingFeesController extends Controller
{

    protected $proccessingFees;
    public function __construct(ProcessingFeesRepositoryInterface $proccessingFees)
    {
        $this->proccessingFees = $proccessingFees;
    }
    function index()
    {
        return $this->proccessingFees->index();
    }

    public function store(ProcessingFeesRequest $request)
    {
        return $this->proccessingFees->store($request);

    }

    public function show($id)
    {
        return $this->proccessingFees->show($id);
    }


    public function edit($id)
    {
        return $this->proccessingFees->edit($id);
    }


    public function update(ProcessingFeesRequest $request)
    {
        return $this->proccessingFees->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->proccessingFees->delete($request);

    }
}
