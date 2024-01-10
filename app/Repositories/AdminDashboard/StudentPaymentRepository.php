<?php

namespace app\Repositories\AdminDashboard;

use App\Models\FoundAccount;
use App\Models\StudentPayment;
use App\Models\Student;
use App\Models\StudentAccount;
use app\Repositories\Interefaces\AdminDashboard\StudentPaymentRepositoryInterface;
use Illuminate\Support\Facades\DB;


class StudentPaymentRepository implements StudentPaymentRepositoryInterface
{
    public function index()
    {
        $studentPayments = StudentPayment::select('id', 'student_id', 'amount', 'description')->get();
        return view('dashboards.admin.payments.index',compact('studentPayments'));
    }


    //create student payments
    public function show($id)
    {
        $student = Student::select('id', 'name')->findorfail($id);
        return view('dashboards.admin.payments.create',compact('student'));
    }


    public function edit($id)
    {
        $studentPayment = StudentPayment::findorfail($id);
        return view('dashboards.admin.payments.edit',compact('studentPayment'));
    }






    ################## Begin Store #########################################################
    public function store($request)
    {
        DB::beginTransaction();

        try {
            $validatedData = $request->validated();

            $studentPayment = $this->createStudentPayment($validatedData);
            $this->createFoundAccount($studentPayment, $request);
            $this->createStudentAccount($studentPayment, $request);

            DB::commit();

            return redirect()->route('student-payments.index')->with(['add_done' => trans('Students_trans.add_done')]);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    private function createStudentPayment($validatedData)
    {
        $validatedData['date'] = date('Y-m-d');
        $validatedData['amount'] = $validatedData['Debit'];

        return StudentPayment::create($validatedData);
    }

    private function createFoundAccount($studentPayment, $request)
    {
        $fundAccount = new FoundAccount();
        $fundAccount->date = date('Y-m-d');
        $fundAccount->payment_id = $studentPayment->id;
        $fundAccount->Debit = 0.00;
        $fundAccount->credit = $request->Debit; // Assuming request has 'Debit' field
        $fundAccount->description = $request->description; // Assuming request has 'description' field
        $fundAccount->save();
    }

    private function createStudentAccount($studentPayment, $request)
    {
        $studentsAccount = new StudentAccount();
        $studentsAccount->date = date('Y-m-d');
        $studentsAccount->type = 'payment';
        $studentsAccount->student_id = $request->student_id; // Assuming request has 'student_id' field
        $studentsAccount->payment_id = $studentPayment->id;
        $studentsAccount->Debit = $request->Debit; // Assuming request has 'Debit' field
        $studentsAccount->credit = 0.00;
        $studentsAccount->description = $request->description; // Assuming request has 'description' field
        $studentsAccount->save();
    }
    ################## End Store #########################################################





    


    public function update($request)
    {
        DB::beginTransaction();

        try {
            $validatedData = $request->validated();

            $this->updateStudentPayment($validatedData, $request->id);
            $this->updateFoundAccount($validatedData, $request->id);
            $this->updateStudentAccount($validatedData, $request->id);

            DB::commit();

            return redirect()->route('student-payments.index')->with(['edit_done' => trans('Students_trans.edit_done')]);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    private function updateStudentPayment($validatedData, $id)
    {
        $paymentStudents = StudentPayment::findOrFail($id);
        $paymentStudents->date = date('Y-m-d');
        $paymentStudents->student_id = $validatedData['student_id'];
        $paymentStudents->amount = $validatedData['Debit'];
        $paymentStudents->description = $validatedData['description'];
        $paymentStudents->save();
    }

    private function updateFoundAccount($validatedData, $id)
    {
        $fundAccounts = FoundAccount::where('payment_id', $id)->first();
        $fundAccounts->date = date('Y-m-d');
        $fundAccounts->payment_id = $id;
        $fundAccounts->Debit = 0.00;
        $fundAccounts->credit = $validatedData['Debit'];
        $fundAccounts->description = $validatedData['description'];
        $fundAccounts->save();
    }

    private function updateStudentAccount($validatedData, $id)
    {
        $studentsAccounts = StudentAccount::where('payment_id', $id)->first();
        $studentsAccounts->date = date('Y-m-d');
        $studentsAccounts->type = 'payment';
        $studentsAccounts->student_id = $validatedData['student_id'];
        $studentsAccounts->payment_id = $id;
        $studentsAccounts->Debit = $validatedData['Debit'];
        $studentsAccounts->credit = 0.00;
        $studentsAccounts->description = $validatedData['description'];
        $studentsAccounts->save();
    }


    public function delete($request)
    {
        try {
            $payment = StudentPayment::findOrFail($request->id);
            $payment->delete();
    
            return redirect()
                ->route('payments_student.index')
                ->with(['delete_done' => trans('Students_trans.delete_done')]);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }
    

}
