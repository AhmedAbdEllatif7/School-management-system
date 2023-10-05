<?php

namespace App\Http\Controllers\school\admin;

use App\Http\Controllers\Controller;
use App\Repository\PaymentStudentRepositoryInterface;
use Illuminate\Http\Request;

class PaymentStudentController extends Controller
{

    protected $payment;
    public function __construct(PaymentStudentRepositoryInterface $payment)
    {
        $this->payment = $payment;
    }
    public function index()
    {
        return $this->payment->index();
    }


    public function create()
    {

    }

    public function store(Request $request)
    {
        return $this->payment->store($request);

    }

    public function show($id)
    {
        return $this->payment->show($id);

    }


    public function edit($id)
    {
        return $this->payment->edit($id);

    }

    public function update(Request $request)
    {
        return $this->payment->update($request);

    }

    public function destroy(Request $request)
    {
        return $this->payment->delete($request);

    }
}
