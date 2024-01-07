<?php

namespace App\Http\Controllers\school\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeesRequest;
use App\Models\Fee;
use App\Repositories\Interefaces\FeesRepositoryInterface;
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


    public function store(FeesRequest $request)
    {
        return $this->fees->store($request);
    }


    public function edit(Fee $fee)
    {
        return $this->fees->edit($fee);
    }


    public function update(FeesRequest $request)
    {
        return $this->fees->update($request);

    }


    public function destroy(Request $request)
    {
        return $this->fees->delete($request);
    }
}
