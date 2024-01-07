<?php

namespace App\Http\Controllers\school\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceFeeRequest;
use App\Repositories\Interefaces\InvoiceFeesRepositoryInterface;
use Illuminate\Http\Request;

class InvoiceFeesController extends Controller
{

    protected $feesInvoices;
    public function __construct(InvoiceFeesRepositoryInterface $feesInvoices)
    {
        $this->feesInvoices = $feesInvoices;
    }
    public function index()
    {
        return $this->feesInvoices->index();
    }

    public function create()
    {
        //
    }


    public function store(InvoiceFeeRequest $request)
    {
        return $this->feesInvoices->store($request);

    }


    public function show($id)
    {
        return $this->feesInvoices->show($id);

    }

    public function edit($id)
    {
        return $this->feesInvoices->edit($id);
    }


    public function update(InvoiceFeeRequest $request)
    {
        return $this->feesInvoices->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->feesInvoices->delete($request);
    }



}
