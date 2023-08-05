<?php

namespace App\Http\Controllers\school;

use App\Http\Controllers\Controller;
use App\Models\ProccrssingFees;
use App\Repository\ProccessingFeesRepositoryInterface;
use App\Repository\StudentRepositoryInterface;
use Illuminate\Http\Request;

class ProccrssingFeesController extends Controller
{

    protected $proccessingFees;
    public function __construct(ProccessingFeesRepositoryInterface $proccessingFees)
    {
        $this->proccessingFees = $proccessingFees;
    }
    function index()
    {
        return $this->proccessingFees->index();
    }


    public function create()
    {

    }


    public function store(Request $request)
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


    public function update(Request $request)
    {
        return $this->proccessingFees->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->proccessingFees->delete($request);

    }
}
