<?php

namespace App\Repositories\ParentDashboard;

use App\Models\Attendance;
use App\Models\Degree;
use App\Models\InvoiceFee;
use App\Models\Parentt;
use App\Models\Receipt;
use App\Models\Student;
use App\Repositories\Interefaces\ParentDashboard\ParentRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class ParentRepository implements ParentRepositoryInterface
{

    public function dashboard()
    {
        $sons = Student::where('parent_id',auth()->user()->id)->get();
        return view('dashboards.parent.dashboard',compact('sons'));
    }


    public function getSons()
    {
        $sons = Student::where('parent_id', auth()->user()->id)->get();
        return view('dashboards.parent.sons.index', compact('sons'));
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


    protected function getSonsForReport()
    {
        return Student::where('parent_id', auth()->user()->id)->get();
    }
    
    public function reportSearch($request)
    {
        $students = $this->getSonsForReport();
    
        if ($request->student_id == 0) {
            $studentIds = $students->pluck('id')->toArray();
            $searchResult = Attendance::whereBetween('attendance_date', [$request->from, $request->to])
                ->whereIn('student_id', $studentIds)
                ->get();
        } else {
            $searchResult = Attendance::whereBetween('attendance_date', [$request->from, $request->to])
                ->where('student_id', $request->student_id)
                ->get();
        }
    
        return view('dashboards.parent.attendance.index', compact('searchResult', 'students'));
    }
    



    public function getSonsFees()
    {
        $studentsIds = Student::where('parent_id', auth()->user()->id)->pluck('id');
        $invoiceFees = InvoiceFee::whereIn('student_id',$studentsIds)->get();
        return view('dashboards.parent.fees.index', compact('invoiceFees'));
    }



    public function getSonsReceipt($id)
    {
        $son = Student::findorFail($id);
        if ($son->parent_id !== auth()->user()->id) {

            return redirect()->route('fee.parent')->with('error_code_degree' ,trans('main_trans.error_code_degree'));
        }

        $sonReceipts = Receipt::where('student_id',$id)->get();

        if ($sonReceipts->isEmpty()) {
            return redirect()->route('sons.fees')->with('error_fee' ,trans('main_trans.error_fee'));
        }
        return view('dashboards.parent.reciept.index', compact('sonReceipts'));
    }



    public function getAttendance()
    {
        $students = Student::where('parent_id', auth()->user()->id)->get();
        return view('dashboards.parent.attendance.index', compact('students'));
    }



    public function viewExamsResult($son_id)
    {
        $student = $this->getStudentById($son_id);
    
        if (!$this->isAuthorizedParent($student)) {
            return $this->redirectToParentDashboardWithError(trans('main_trans.error_code_degree'));
        }
    
        $degrees = $this->getStudentDegrees($son_id);
    
        if ($degrees->isEmpty()) {
            return redirect()->back()->with('error_degree', trans('main_trans.error_degree'));
        }
    
        return view('dashboards.parent.degrees.index', compact('degrees'));
    }
    
    private function getStudentById($studentId)
    {
        return Student::findOrFail($studentId);
    }
    
    private function isAuthorizedParent($student)
    {
        return $student->parent_id === auth()->user()->id;
    }
    
    private function redirectToParentDashboardWithError($errorMessage)
    {
        return redirect()->route('parent.dashboard')->with('error_code_degree', $errorMessage);
    }
    
    private function getStudentDegrees($studentId)
    {
        return Degree::where('student_id', $studentId)->get();
    }
    
}
