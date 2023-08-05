<?php

namespace App\Http\Controllers\school;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeesRequest;
use App\Models\Fees;
use App\Models\Grade;
use App\Repository\FeesRepositoryInterface;
use Illuminate\Http\Request;

class FeesController extends Controller
{
    protected $fees;
    public function __construct(FeesRepositoryInterface $fees)
    {
         $this->fees = $fees;
    }

    public function index()
    {
        return $this->fees->index();
    }


    public function create()
    {
        return $this->fees->create();

    }


    public function store(StoreFeesRequest $request)
    {
        return $this->fees->storeFees($request);
    }


    public function show(Fees $fees)
    {
        return $this->fees->editFees();

    }


    public function edit($fee)
    {
        return $this->fees->editFees($fee);
    }


    public function update(Request $request)
    {
        return $this->fees->updateFees($request);

    }


    public function destroy(Request $request)
    {
        return $this->fees->deleteFees($request);
    }
}
