<?php

namespace App\Repositories\Interefaces\AdminDashboard;

interface AttendanceRepositoryInterface
{
    public function index();

    public function show($id);

    public function store($request);

}
