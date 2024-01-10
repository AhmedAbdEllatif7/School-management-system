<?php

namespace App\Repositories;

use App\Models\Fee;
use App\Models\InvoiceFee;
use App\Models\Student;
use App\Models\StudentAccount;
use App\Repositories\Interefaces\InvoiceFeesRepositoryInterface;
use Illuminate\Support\Facades\DB;

class InvoiceFeesRepository implements InvoiceFeesRepositoryInterface
{
    public function index()
    {
        $invoicesFee = InvoiceFee::select('id', 'description', 'amount', 'student_id', 'classroom_id', 'grade_id', 'fee_id')->get();
        return view('dashboards.admin.invoicesFee.index',compact('invoicesFee'));
    }


    //Create invoice fee of specefic student
    public function show($id)
    {
        $student = Student::findOrFail($id);
        $fees = Fee::where('classroom_id' , $student->classroom_id)->get();
        return view('dashboards.admin.invoicesFee.create' , compact('student' , 'fees'));
    }




    ############## Begin Store ######################################################################
    public function store($request)
    {
        $listOfFees = $request->listOfFees;

        DB::beginTransaction();

        try {
            foreach ($listOfFees as $listOfFee) {
                $invoiceFee = $this->createInvoiceFee($listOfFee);
                $this->createStudentAccount($listOfFee, $invoiceFee);
            }

            DB::commit();

            return redirect()->route('invoices-fees.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    private function createInvoiceFee($listOfFee)
    {
        $listOfFee['invoice_date'] = date('Y-m-d');
        return InvoiceFee::create($listOfFee);
    }

    private function createStudentAccount($listOfFee, $invoiceFee)
    {
        StudentAccount::create([
            'date' => date('Y-m-d'),
            'type' => 'invoice',
            'fee_invoice_id' => $invoiceFee->id,
            'student_id' => $listOfFee['student_id'],
            'Debit' => $listOfFee['amount'],
            'credit' => 0.00,
            'description' => $listOfFee['description'],
        ]);
    }
    ############## End Store ######################################################################





        public function edit($id)
        {
            $invoiceFee = InvoiceFee::findOrFail($id);
            $fees = Fee::where('classroom_id' , $invoiceFee->classroom_id)->get();
            return view('dashboards.admin.invoicesFee.edit', compact('invoiceFee', 'fees'));
        }



    ############## Begin Update ######################################################################
        public function update($request)
        {
            DB::beginTransaction();
            $validatedData = $request->validated();
            try {
                $this->updateInvoiceFee($request);
                $this->updateStudentAccount($request);
        
                DB::commit();
        
                return redirect()->route('invoices-fees.index')->with(['edit_invoice_fees' => trans('Students_trans.edit_done')]);
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }
        
        private function updateInvoiceFee($request)
        {
            $invoiceFee = InvoiceFee::findOrFail($request->id);
            $invoiceFee->fee_id = $request->fee_id;
            $invoiceFee->amount = $request->amount;
            $invoiceFee->description = $request->description;
            $invoiceFee->save();
        }
        
        private function updateStudentAccount($request)
        {
            $studentAccount = StudentAccount::where('fee_invoice_id', $request->id)->firstOrFail();
            $studentAccount->Debit = $request->amount;
            $studentAccount->description = $request->description;
            $studentAccount->save();
        }
    ############## End Update ######################################################################
        


        public function delete($request)
        {
            try {
                $invoiceFee = InvoiceFee::findOrFail($request->id);

                $invoiceFee->delete();
                return redirect()->route('fees_invoices.index')->with(['delete_invoice_fees' => trans('Students_trans.delete_done')]);
            }

            catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }


}
