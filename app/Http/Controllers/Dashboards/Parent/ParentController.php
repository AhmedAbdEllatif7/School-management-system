<?php

namespace App\Http\Controllers\Dashboards\Parent;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceReportRequest;
use App\Repositories\Interefaces\ParentDashboard\ParentRepositoryInterface;
use Illuminate\Http\Request;

class ParentController extends Controller
{

    protected $ParentDashboard;

    public function __construct(ParentRepositoryInterface $ParentDashboard)
    {
        $this->ParentDashboard = $ParentDashboard;
    }

    public function dashboard()
    {
        return $this->ParentDashboard->dashboard();
    }

    public function getSons()
    {
        return $this->ParentDashboard->getSons();
    }

    public function reportSearch(AttendanceReportRequest $request)
    {
        return $this->ParentDashboard->reportSearch($request);

    }

    public function getSonsFees()
    {
        return $this->ParentDashboard->getSonsFees();

    }


    public function getSonsReceipt($id)
    {

        return $this->ParentDashboard->getSonsReceipt($id);

    }


    public function update(Request $request, $id)
    {

        return $this->ParentDashboard->update($request , $id);


    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function viewExamsResult($son_id)
    {
        return $this->ParentDashboard->viewExamsResult($son_id);

    }

    public function getAttendance()
    {
        return $this->ParentDashboard->getAttendance();

    }


    public function edit(string $id)
    {
        //
    }




    public function destroy(string $id)
    {
        //
    }
}
