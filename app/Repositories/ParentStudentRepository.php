<?php

namespace App\Repositories;

use App\Models\Attendance;
use App\Models\Degree;
use App\Models\Fees_invoice;
use App\Models\Parentt;
use App\Models\Receipt;
use App\Models\Student;
use App\Repositories\Interefaces\ParentStudentRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ParentStudentRepository implements ParentStudentRepositoryInterface
{

    public function index()
    {
        $students = Student::where('parent_id', auth()->user()->id)->get();
        return view('pages.parents.student', compact('students'));
    }




    public function update($request, $id)
    {

        $information = Parentt::findorFail($id);

        if (!empty($request->password)) {
            $information->Name_Father = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->password = Hash::make($request->password);
            $information->save();
        } else {
            $information->Name_Father = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->save();
        }
        return redirect()->back();
    }



    public function filterAttendances($request)
    {
        try {
            $request->validate([
                'student_id' => 'nullable|integer', // Make sure student_id is an integer if provided
                'from' => 'required|date|date_format:Y-m-d', // Validate from date format
                'to' => 'required|date|date_format:Y-m-d|after_or_equal:from', // Validate to date format and make sure it's after or equal to from date
            ], [
                'from.required' => trans('main_trans.start_date_required'),
                'from.date_format' => trans('main_trans.start_date_format'),
                'to.required' => trans('main_trans.end_date_required'),
                'to.date_format' => trans('main_trans.end_date_format'),
                'to.after_or_equal' => trans('main_trans.end_date_after_or_equal_start'),
            ]);

            $studentsID = DB::table('students')->where('parent_id', auth()->user()->id)->pluck('id');
            $students = Student::whereIn('id', $studentsID)->get();
            if ($request->student_id == 0) {
                $Students = Attendance::whereBetween('attendance_date', [$request->from, $request->to])
                    ->whereIn('student_id', $studentsID)
                    ->get();
                return view('pages.parents.Attendance.index', compact('Students', 'students'));
            } else {
                $studentId = $request->student_id;
                $Students = Attendance::whereBetween('attendance_date', [$request->from, $request->to])
                    ->where('student_id', $studentId)
                    ->get();
                return view('pages.parents.Attendance.index', compact('Students', 'students'));
            }


        } catch (\Exception $e) {

            return redirect('attendance-report')->withErrors($e->getMessage());
        }    }


    public function fees()
    {
        $students_ids = Student::where('parent_id', auth()->user()->id)->pluck('id');
        $Fee_invoices = Fees_invoice::whereIn('student_id',$students_ids)->get();
        return view('pages.parents.fees.index', compact('Fee_invoices'));
    }



    public function receiptStudent($id)
    {
        $student = Student::findorFail($id);
        if ($student->parent_id !== auth()->user()->id) {

            return redirect()->route('fee.parent')->with('error_code_degree' ,trans('main_trans.error_code_degree'));
        }

        $receipt_students = Receipt::where('student_id',$id)->get();

        if ($receipt_students->isEmpty()) {
            return redirect()->route('fee.parent')->with('error_fee' ,trans('main_trans.error_fee'));
        }
        return view('pages.parents.reciept.index', compact('receipt_students'));
    }



    public function profile()
    {
        $information = Parentt::findorFail(auth()->user()->id);
        return view('pages.parents.profile', compact('information'));
    }



    public function getAttendance()
    {
        $students = Student::where('parent_id', auth()->user()->id)->get();
        return view('pages.parents.Attendance.index', compact('students'));
    }



    public function show($id)
    {
        $student = Student::findorFail($id);

        if ($student->parent_id !== auth()->user()->id) {
            return redirect()->route('parent-dashboard.index')->with('error_code_degree' ,trans('main_trans.error_code_degree'));

        }
        $degrees = Degree::where('student_id', $id)->get();

        if ($degrees->isEmpty()) {
            return redirect()->back()->with('error_degree' ,trans('main_trans.error_degree'));
        }

        return view('pages.parents.degrees', compact('degrees'));
    }
}
