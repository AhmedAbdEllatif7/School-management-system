<?php

namespace App\Repositories;

use App\Models\ProcessingFee;
use App\Models\Student;
use App\Models\StudentAccount;
use App\Repositories\Interefaces\ProcessingFeesRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProcessingFeesRepository implements ProcessingFeesRepositoryInterface
{

    public function index()
    {
        $processingFees = ProcessingFee::select('id', 'date', 'student_id', 'amount', 'description')->get();
        return view('pages.adminDashboard.processingFee.index',compact('processingFees'));
    }


    //create Student processingFees
    public function show($id)
    {
        $student = Student::select('id', 'name')->findorfail($id);
        return view('pages.adminDashboard.processingFee.create',compact('student'));
    }



    public function edit($id)
    {
        $processingFee = ProcessingFee::findorfail($id);
        return view('pages.adminDashboard.processingFee.edit',compact('processingFee'));
    }




################## Begin Store #########################################################
    public function store($request)
    {
        DB::beginTransaction();

        try {
            $validatedData = $request->validated();
            $validatedData['date'] = date('Y-m-d');
            $validatedData['amount'] = $validatedData['Debit'];

            $processingFee = $this->createProcessingFee($validatedData);

            $this->createStudentAccount($processingFee->id,$request->student_id,$validatedData['amount'],$validatedData['description']);

            DB::commit();
            return redirect()->route('processing-fees.index')->with(['add_done' => trans('Students_trans.add_done')]);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    private function createProcessingFee($validatedData)
    {
        return ProcessingFee::create($validatedData);
    }

    private function createStudentAccount($processingFeeId, $studentId, $amount, $description)
    {
        $students_accounts = new StudentAccount();
        $students_accounts->date = date('Y-m-d');
        $students_accounts->type = 'processingFee';
        $students_accounts->student_id = $studentId;
        $students_accounts->processing_id = $processingFeeId;
        $students_accounts->Debit = 0.00;
        $students_accounts->credit = $amount;
        $students_accounts->description = $description;
        $students_accounts->save();
    }
################## End Store #########################################################








################## Begin Update #########################################################
    public function update($request)
    {
        DB::beginTransaction();
    
        try {
            $validatedData = $request->validated();
            $validatedData['date'] = date('Y-m-d');
            $validatedData['amount'] = $validatedData['Debit'];

            $processingFee = $this->updateProcessingFee($request->id, $validatedData);
            $this->updateStudentAccount($processingFee->id, $request->student_id, $validatedData);
    
            DB::commit();
            return redirect()->route('processing-fees.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('processing-fees.index')->with(['edit_done' => trans('Students_trans.edit_done')]);
        }
    }
    
    private function updateProcessingFee($id, $validatedData)
    {
        $processingFee = ProcessingFee::findOrFail($id);
        $processingFee->update($validatedData);
        return $processingFee;
    }
    
    private function updateStudentAccount($processingFeeId, $studentId, $validatedData)
    {
        $studentsAccount = StudentAccount::where('processing_id', $processingFeeId)->firstOrFail();
        $studentsAccount->date = date('Y-m-d');
        $studentsAccount->type = 'processingFee';
        $studentsAccount->student_id = $studentId;
        $studentsAccount->processing_id = $processingFeeId;
        $studentsAccount->Debit = 0.00;
        $studentsAccount->credit = $validatedData['amount'];
        $studentsAccount->description = $validatedData['description'];
        $studentsAccount->save();
    }
################## End Update #########################################################
    

    

    public function delete($request)
    {
        try {
            ProcessingFee::findOrFail($request->id)->delete();
            return redirect()->route('processing-fees.index')->with(['delete_done' => trans('Students_trans.delete_done')]);
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
