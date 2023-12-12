<?php

namespace App\Repositories;

use App\Models\Fees;
use App\Models\Fees_invoice;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Student_Account;
use App\Repositories\Interefaces\FeesInvoicesRepositoryInterface;
use Illuminate\Support\Facades\DB;

class FeesInvoicesRepository implements FeesInvoicesRepositoryInterface
{
    public function index()
    {
        $Fee_invoices = Fees_invoice::all();
        $Grades = Grade::all();
        return view('pages.Fees_Invoices.index',compact('Fee_invoices','Grades'));
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        $fees = Fees::where('classroom_id' , $student->classroom_id)->get();
        return view('pages.Fees_Invoices.add' , compact(['student' , 'fees']));
    }

    public function store($request)
    {
        $List_Fees = $request->List_Fees;

        DB::beginTransaction();

        try {

            foreach ($List_Fees as $List_Fee) {
                // حفظ البيانات في جدول فواتير الرسوم الدراسية
                $Fees = new Fees_invoice();
                $Fees->invoice_date = date('Y-m-d');
                $Fees->student_id = $List_Fee['student_id'];
                $Fees->grade_id = $request->Grade_id;
                $Fees->classroom_id = $request->Classroom_id;;
                $Fees->fee_id = $List_Fee['fee_id'];
                $Fees->amount = $List_Fee['amount'];
                $Fees->description = $List_Fee['description'];
                $Fees->save();

                // حفظ البيانات في جدول حسابات الطلاب
                $StudentAccount = Student_Account::create([
                    'date' => date('Y-m-d'),
                    'type' => 'invoice',
                    'fee_invoice_id' => $Fees->id,
                    'student_id' => $List_Fee['student_id'],
                    'Debit' => $List_Fee['amount'],
                    'credit' => 0.00,
                    'description' => $List_Fee['description'],
                ]);

            }

            DB::commit();

            return redirect()->route('fees_invoices.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

        public function edit($id)
        {
            $fee_invoices = Fees_invoice::findOrFail($id);
            $fees = Fees::where('classroom_id' , $fee_invoices->classroom_id)->get();
            return view('pages.Fees_Invoices.edit' , compact('fee_invoices' , 'fees'));
        }

        public function update($request)
        {
            DB::beginTransaction();
            try {
                // تعديل البيانات في جدول فواتير الرسوم الدراسية
                $Fees = Fees_invoice::findorfail($request->id);
                $Fees->fee_id = $request->fee_id;
                $Fees->amount = $request->amount;
                $Fees->description = $request->description;
                $Fees->save();

                // تعديل البيانات في جدول حسابات الطلاب
                $StudentAccount = Student_Account::where('fee_invoice_id',$request->id)->first();
                $StudentAccount->Debit = $request->amount;
                $StudentAccount->description = $request->description;
                $StudentAccount->save();
                DB::commit();

                return redirect()->route('fees_invoices.index')->with(['edit_invoice_fees' => trans('Students_trans.edit_done')]);
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }


        public function delete($request)
        {
            try {
                Fees_invoice::destroy($request->id);
                return redirect()->route('fees_invoices.index')->with(['delete_invoice_fees' => trans('Students_trans.delete_done')]);
            }

            catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }


}
