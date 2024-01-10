<?php

namespace App\Http\Controllers\Dashboards\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Repositories\Interefaces\AdminDashboard\StudentPaymentRepositoryInterface;
use Illuminate\Http\Request;

class StudentPaymentController extends Controller
{

    protected $payment;
    public function __construct(StudentPaymentRepositoryInterface $payment)
    {
        $this->payment = $payment;
    }
    public function index()
    {
        return $this->payment->index();
    }


    public function store(PaymentRequest $request)
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

    public function update(PaymentRequest $request)
    {
        return $this->payment->update($request);

    }

    public function destroy(Request $request)
    {
        return $this->payment->delete($request);

    }
}
