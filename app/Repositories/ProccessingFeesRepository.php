<?php

namespace App\Repositories;

use App\Models\ProccrssingFees;
use App\Models\Student;
use App\Models\Student_Account;
use App\Repositories\Interefaces\ProccessingFeesRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProccessingFeesRepository implements ProccessingFeesRepositoryInterface
{

    public function index()
    {
        $ProcessingFees = ProccrssingFees::all();
        return view('pages.ProcessingFee.index',compact('ProcessingFees'));
    }

    public function show($id)
    {
        $student = Student::findorfail($id);
        return view('pages.ProcessingFee.add',compact('student'));
    }

    public function edit($id)
    {
        $ProcessingFee = ProccrssingFees::findorfail($id);
        return view('pages.ProcessingFee.edit',compact('ProcessingFee'));
    }

    public function store($request)
    {
        // Define validation rules
        $rules = [
            'student_id' => [
                'required',
                'integer',
                Rule::exists('students', 'id'), // Check if the student_id exists in the students table
            ],
            'Debit' => 'required|numeric|min:0',
            'description' => 'required|string',
        ];

        // Define custom error messages
        $messages = [
            'student_id.required' => __('main_trans.student_id.required'),
            'student_id.integer' => __('main_trans.student_id.integer'),
            'student_id.exists' => __('main_trans.student_id.exists'),
            'Debit.required' => __('main_trans.Debit.required'),
            'Debit.numeric' => __('main_trans.Debit.numeric'),
            'Debit.min' => __('main_trans.Debit.min', ['min' => 0]),
            'description.required' => __('main_trans.description.required'),
            'description.string' => __('main_trans.description.string'),
        ];

        // Validate the request data with custom error messages
        $validator = Validator::make($request->all(), $rules, $messages);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            // Save the data in the ProcessingFee model
            $ProcessingFee = new ProccrssingFees();
            $ProcessingFee->date = date('Y-m-d');
            $ProcessingFee->student_id = $request->student_id;
            $ProcessingFee->amount = $request->Debit;
            $ProcessingFee->description = $request->description;
            $ProcessingFee->save();

            // Save the data in the Student_Account model
            $students_accounts = new Student_Account();
            $students_accounts->date = date('Y-m-d');
            $students_accounts->type = 'ProcessingFee';
            $students_accounts->student_id = $request->student_id;
            $students_accounts->processing_id = $ProcessingFee->id;
            $students_accounts->Debit = 0.00;
            $students_accounts->credit = $request->Debit;
            $students_accounts->description = $request->description;
            $students_accounts->save();

            DB::commit();
            return redirect()->route('processing_fees.index')->with(['add_done' => trans('Students_trans.add_done')]);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
//
    public function update($request)
    {

        // Define validation rules
        $rules = [
            'student_id' => [
                'required',
                'integer',
                Rule::exists('students', 'id'), // Check if the student_id exists in the students table
            ],
            'Debit' => 'required|numeric|min:0',
            'description' => 'required|string',
        ];

        // Define custom error messages
        $messages = [
            'student_id.required' => __('main_trans.student_id.required'),
            'student_id.integer' => __('main_trans.student_id.integer'),
            'student_id.exists' => __('main_trans.student_id.exists'),
            'Debit.required' => __('main_trans.Debit.required'),
            'Debit.numeric' => __('main_trans.Debit.numeric'),
            'Debit.min' => __('main_trans.Debit.min', ['min' => 0]),
            'description.required' => __('main_trans.description.required'),
            'description.string' => __('main_trans.description.string'),
        ];

        // Validate the request data with custom error messages
        $validator = Validator::make($request->all(), $rules, $messages);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        DB::beginTransaction();

        try {
            // تعديل البيانات في جدول معالجة الرسوم
            $ProcessingFee = ProccrssingFees::findorfail($request->id);;
            $ProcessingFee->date = date('Y-m-d');
            $ProcessingFee->student_id = $request->student_id;
            $ProcessingFee->amount = $request->Debit;
            $ProcessingFee->description = $request->description;
            $ProcessingFee->save();

            // تعديل البيانات في جدول حساب الطلاب
            $students_accounts = Student_Account::where('processing_id',$request->id)->first();;
            $students_accounts->date = date('Y-m-d');
            $students_accounts->type = 'ProcessingFee';
            $students_accounts->student_id = $request->student_id;
            $students_accounts->processing_id = $ProcessingFee->id;
            $students_accounts->Debit = 0.00;
            $students_accounts->credit = $request->Debit;
            $students_accounts->description = $request->description;
            $students_accounts->save();


            DB::commit();
            return redirect()->route('ProcessingFee.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('processing_fees.index')->with(['edit_done' => trans('Students_trans.edit_done')]);
        }
    }

    public function delete($request)
    {
        try {
            ProccrssingFees::findOrFail($request->id)->delete();
            return redirect()->route('processing_fees.index')->with(['delete_done' => trans('Students_trans.delete_done')]);
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
