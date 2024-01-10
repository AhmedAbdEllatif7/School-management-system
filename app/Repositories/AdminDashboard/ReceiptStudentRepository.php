<?php

namespace app\Repositories\AdminDashboard;

use App\Models\FoundAccount;
use App\Models\Receipt;
use App\Models\Student;
use App\Models\StudentAccount;
use app\Repositories\Interefaces\AdminDashboard\ReceiptStudentRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ReceiptStudentRepository implements ReceiptStudentRepositoryInterface {

    public function index()
    {
        $studentReceipts = Receipt::select('id', 'student_id', 'debit', 'description')->get();

        return view('dashboards.admin.receipts.index',compact('studentReceipts'));
    }

    public function show($id)
    {
        $student = Student::select('id', 'name')->findorfail($id);
        return view('dashboards.admin.receipts.create' , compact('student'));
    }

    public function edit($id)
    {
        $receipt_student = Receipt::findorfail($id);
        return view('dashboards.admin.receipts.edit',compact('receipt_student'));
    }

    




##################### Begin Store #####################################################
    public function store($request)
    {
        DB::beginTransaction();
    
        try {
            $receipt = $this->createReceipt($request->validated());
    
            $this->createFoundAccount($receipt, $request->debit, $request->description);
            $this->createStudentAccount($receipt, $request->student_id, $request->debit, $request->description);
    
            DB::commit();
    
            return redirect()->route('student-receipt.index')->with(['add_done' => trans('Students_trans.add_done')]);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    



    private function createReceipt(array $validatedData)
    {
        $validatedData['date'] = date('Y-m-d');
        return Receipt::create($validatedData);
    }

    
    private function createFoundAccount($receipt, $debit, $description)
    {
        FoundAccount::create([
            'date' => date('Y-m-d'),
            'receipt_id' => $receipt->id,
            'Debit' => $debit,
            'credit' => 0.00,
            'description' => $description,
        ]);
    }
    
    private function createStudentAccount($receipt, $studentId, $debit, $description)
    {
        StudentAccount::create([
            'date' => date('Y-m-d'),
            'type' => 'receipt',
            'receipt_id' => $receipt->id,
            'student_id' => $studentId,
            'Debit' => 0.00,
            'credit' => $debit,
            'description' => $description,
        ]);
    }
    ##################### End Store #####################################################
    












    ############### Begin Update #####################################################
    public function update($request)
    {
        try {
            DB::beginTransaction();

            $receipt = $this->updateReceipt($request->validated(), $request->id);
            $this->updateFoundAccount($receipt, $request->debit, $request->description, $request->id);
            $this->updateStudentAccount($receipt, $request->student_id, $request->debit, $request->description, $request->id);

            DB::commit();
            
            return redirect()->route('student-receipt.index')->with(['edit_done' => trans('Students_trans.edit_done')]);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    private function updateReceipt(array $validatedData, $id)
    {
        $receipt = Receipt::findOrFail($id);
        $receipt->update([
            'date' => date('Y-m-d'),
            'student_id' => $validatedData['student_id'],
            'debit' => $validatedData['debit'],
            'description' => $validatedData['description'],
        ]);

        return $receipt;
    }

    private function updateFoundAccount($receipt, $debit, $description, $id)
    {
        $foundAccount = FoundAccount::where('receipt_id', $id)->firstOrFail();
        $foundAccount->update([
            'date' => date('Y-m-d'),
            'receipt_id' => $receipt->id,
            'Debit' => $debit,
            'credit' => 0.00,
            'description' => $description,
        ]);
    }

    private function updateStudentAccount($receipt, $studentId, $debit, $description, $id)
    {
        $studentAccount = StudentAccount::where('receipt_id', $id)->firstOrFail();
        $studentAccount->update([
            'date' => date('Y-m-d'),
            'type' => 'receipt',
            'student_id' => $studentId,
            'receipt_id' => $receipt->id,
            'Debit' => 0.00,
            'credit' => $debit,
            'description' => $description,
        ]);
    }
    ############### End Update #####################################################





    public function delete($request)
{
    try {
        $receipt = Receipt::findOrFail($request->id);
        $receipt->delete();

        return redirect()->route('student-receipt.index')->with(['delete_done' => trans('Students_trans.delete_done')]);
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
}

}
