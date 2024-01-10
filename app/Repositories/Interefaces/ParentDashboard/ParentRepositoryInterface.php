<?php

namespace App\Repositories\Interefaces\ParentDashboard;

interface ParentRepositoryInterface
{
    public function dashboard();

    public function getSons();

    public function viewExamsResult($son_id);

    public function update($request, $id);

    public function reportSearch($request);

    public function getSonsFees();

    public function getSonsReceipt($id);

    public function getAttendance();

}
