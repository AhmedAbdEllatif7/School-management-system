<?php

namespace App\Repositories;

use App\Models\FoundAccount;
use App\Models\Payment_student;
use App\Models\Student;
use App\Models\Student_Account;
use App\Repositories\Interefaces\PaymentStudentRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PaymentStudentRepository implements PaymentStudentRepositoryInterface
{
    public function index()
    {
        $payment_students = Payment_student::all();
        return view('pages.Payment.index',compact('payment_students'));
    }

    public function show($id)
    {
        $student = Student::findorfail($id);
        return view('pages.Payment.add',compact('student'));
    }



    public function edit($id)
    {
        $payment_student = Payment_student::findorfail($id);
        return view('pages.Payment.edit',compact('payment_student'));
    }

    public function store($request)
    {

        // Define validation rules
        $rules = [
            'student_id' => [
                'required',
                'integer',
                Rule::exists('students', 'id')->where(function ($query) use ($request) {
                    $query->where('id', $request->student_id);
                }),
            ],
            'Debit' => 'required|numeric|min:0',
            'description' => 'required|string',
        ];

        // Define custom error messages
        $messages = [
            'student_id.required' => trans('main_trans.student_id.required'),
            'student_id.integer' => trans('main_trans.student_id.integer'),
            'student_id.exists' => trans('main_trans.student_id.exists'),
            'Debit.required' => trans('main_trans.Debit.required'),
            'Debit.numeric' => trans('main_trans.Debit.numeric'),
            'Debit.min' => trans('main_trans.Debit.min', ['min' => 0]),
            'description.required' => trans('main_trans.description.required'),
            'description.string' => trans('main_trans.description.string'),
        ];

        // Validate the request data with custom error messages
        $validator = Validator::make($request->all(), $rules, $messages);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {

            // حفظ البيانات في جدول سندات الصرف
            $payment_students = new Payment_student();
            $payment_students->date = date('Y-m-d');
            $payment_students->student_id = $request->student_id;
            $payment_students->amount = $request->Debit;
            $payment_students->description = $request->description;
            $payment_students->save();


            // حفظ البيانات في جدول الصندوق
            $fund_accounts = new FoundAccount();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->payment_id = $payment_students->id;
            $fund_accounts->Debit = 0.00;
            $fund_accounts->credit = $request->Debit;
            $fund_accounts->description = $request->description;
            $fund_accounts->save();


            // حفظ البيانات في جدول حساب الطلاب
            $students_accounts = new Student_Account();
            $students_accounts->date = date('Y-m-d');
            $students_accounts->type = 'payment';
            $students_accounts->student_id = $request->student_id;
            $students_accounts->payment_id = $payment_students->id;
            $students_accounts->Debit = $request->Debit;
            $students_accounts->credit = 0.00;
            $students_accounts->description = $request->description;
            $students_accounts->save();

            DB::commit();
            return redirect()->route('payments_student.index')->with(['add_done' => trans('Students_trans.add_done')]);
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
                Rule::exists('students', 'id')->where(function ($query) use ($request) {
                    $query->where('id', $request->student_id);
                }),
            ],
            'Debit' => 'required|numeric|min:0',
            'description' => 'required|string',
        ];

        // Define custom error messages
        $messages = [
            'student_id.required' => trans('main_trans.student_id.required'),
            'student_id.integer' => trans('main_trans.student_id.integer'),
            'student_id.exists' => trans('main_trans.student_id.exists'),
            'Debit.required' => trans('main_trans.Debit.required'),
            'Debit.numeric' => trans('main_trans.Debit.numeric'),
            'Debit.min' => trans('main_trans.Debit.min', ['min' => 0]),
            'description.required' => trans('main_trans.description.required'),
            'description.string' => trans('main_trans.description.string'),
        ];

        // Validate the request data with custom error messages
        $validator = Validator::make($request->all(), $rules, $messages);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction();

        try {

            // تعديل البيانات في جدول سندات الصرف
            $payment_students = Payment_student::findorfail($request->id);
            $payment_students->date = date('Y-m-d');
            $payment_students->student_id = $request->student_id;
            $payment_students->amount = $request->Debit;
            $payment_students->description = $request->description;
            $payment_students->save();


            // حفظ البيانات في جدول الصندوق
            $fund_accounts = FoundAccount::where('payment_id',$request->id)->first();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->payment_id = $payment_students->id;
            $fund_accounts->Debit = 0.00;
            $fund_accounts->credit = $request->Debit;
            $fund_accounts->description = $request->description;
            $fund_accounts->save();


            // حفظ البيانات في جدول حساب الطلاب
            $students_accounts = Student_Account::where('payment_id',$request->id)->first();
            $students_accounts->date = date('Y-m-d');
            $students_accounts->type = 'payment';
            $students_accounts->student_id = $request->student_id;
            $students_accounts->payment_id = $payment_students->id;
            $students_accounts->Debit = $request->Debit;
            $students_accounts->credit = 0.00;
            $students_accounts->description = $request->description;
            $students_accounts->save();
            DB::commit();

            return redirect()->route('payments_student.index')->with(['edit_done' => trans('Students_trans.edit_done')]);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
//
    public function delete($request)
    {
        try {
            Payment_student::destroy($request->id);
            return redirect()->route('payments_student.index')->with(['delete_done' => trans('Students_trans.delete_done')]);
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


}
