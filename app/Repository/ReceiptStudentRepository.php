<?php

namespace App\Repository;

use App\Models\FoundAccount;
use App\Models\Receipt;
use App\Models\Student;
use App\Models\Student_Account;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReceiptStudentRepository implements ReceiptStudentRepositoryInterface{
    public function index()
    {
        $receipt_students = Receipt::all();
        return view('pages.Receipt.index',compact('receipt_students'));
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('pages.Receipt.add' , compact('student'));
    }

    public function edit($id)
    {
        $receipt_student = Receipt::findorfail($id);
        return view('pages.Receipt.edit',compact('receipt_student'));
    }

    public function delete($request)
    {
        try {
            Receipt::destroy($request->id);
            return redirect()->route('receipt_student.index')->with(['delete_done' => trans('Students_trans.delete_done')]);
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function store($request)
    {
        // Validation rules
        $rules = [
            'student_id' => 'required|integer|exists:students,id',
            'Debit' => 'required|numeric|min:0',
            'description' => 'required|string',
        ];

        // Custom error messages
        $messages = [
            'student_id.required' => 'The student ID is required.',
            'student_id.integer' => 'The student ID must be an integer.',
            'student_id.exists' => 'The selected student does not exist in the students table.',
            'Debit.required' => 'The Debit amount is required.',
            'Debit.numeric' => 'The Debit amount must be a number.',
            'Debit.min' => 'The Debit amount must be at least :min.',
            'description.required' => 'The description is required.',
            'description.string' => 'The description must be a string.',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules, $messages);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            // Save the data in the Receipt model
            $receipt_students = new Receipt();
            $receipt_students->date = date('Y-m-d');
            $receipt_students->student_id = $request->student_id;
            $receipt_students->Debit = $request->Debit;
            $receipt_students->description = $request->description;
            $receipt_students->save();

            // Save the data in the FoundAccount model
            $fund_accounts = new FoundAccount();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->receipt_id = $receipt_students->id;
            $fund_accounts->Debit = $request->Debit;
            $fund_accounts->credit = 0.00;
            $fund_accounts->description = $request->description;
            $fund_accounts->save();

            // Save the data in the Student_Account model
            $fund_accounts = new Student_Account();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->type = 'receipt';
            $fund_accounts->receipt_id = $receipt_students->id;
            $fund_accounts->student_id = $request->student_id;
            $fund_accounts->Debit = 0.00;
            $fund_accounts->credit = $request->Debit;
            $fund_accounts->description = $request->description;
            $fund_accounts->save();

            DB::commit();
            return redirect()->route('receipt_student.index')->with(['add_done' => trans('Students_trans.add_done')]);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request)
    {

        // Validation rules
        $rules = [
            'student_id' => 'required|integer|exists:students,id'.$request->id,
            'Debit' => 'required|numeric|min:0',
            'description' => 'required|string',
        ];

        // Custom error messages
        $messages = [
            'student_id.required' => 'The student ID is required.',
            'student_id.integer' => 'The student ID must be an integer.',
            'student_id.exists' => 'The selected student does not exist in the students table.',
            'Debit.required' => 'The Debit amount is required.',
            'Debit.numeric' => 'The Debit amount must be a number.',
            'Debit.min' => 'The Debit amount must be at least :min.',
            'description.required' => 'The description is required.',
            'description.string' => 'The description must be a string.',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules, $messages);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            // تعديل البيانات في جدول سندات القبض
            $receipt_students = Receipt::findorfail($request->id);
            $receipt_students->date = date('Y-m-d');
            $receipt_students->student_id = $request->student_id;
            $receipt_students->Debit = $request->Debit;
            $receipt_students->description = $request->description;
            $receipt_students->save();

            // تعديل البيانات في جدول الصندوق
            $fund_accounts = FoundAccount::where('receipt_id',$request->id)->first();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->receipt_id = $receipt_students->id;
            $fund_accounts->Debit = $request->Debit;
            $fund_accounts->credit = 0.00;
            $fund_accounts->description = $request->description;
            $fund_accounts->save();

            // تعديل البيانات في جدول الصندوق

            $fund_accounts = Student_Account::where('receipt_id',$request->id)->first();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->type = 'receipt';
            $fund_accounts->student_id = $request->student_id;
            $fund_accounts->receipt_id = $receipt_students->id;
            $fund_accounts->Debit = 0.00;
            $fund_accounts->credit = $request->Debit;
            $fund_accounts->description = $request->description;
            $fund_accounts->save();


            DB::commit();
            return redirect()->route('receipt_student.index')->with(['edit_done' => trans('Students_trans.edit_done')]);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



}
