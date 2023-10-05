<?php

namespace App\Http\Controllers\school\admin;

use App\Http\Controllers\Controller;
use App\Repository\FeesInvoicesRepositoryInterface;
use Illuminate\Http\Request;

class FeesInvoicesController extends Controller
{

    protected $FeesInvoices;
    public function __construct(FeesInvoicesRepositoryInterface $FeesInvoices)
    {
        $this->FeesInvoices = $FeesInvoices;
    }
    public function index()
    {
        return $this->FeesInvoices->index();
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        return $this->FeesInvoices->store($request);

    }


    public function show($id)
    {
        return $this->FeesInvoices->show($id);

    }

    public function edit($id)
    {
        return $this->FeesInvoices->edit($id);
    }


    public function update(Request $request)
    {
        return $this->FeesInvoices->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->FeesInvoices->delete($request);
    }



}
