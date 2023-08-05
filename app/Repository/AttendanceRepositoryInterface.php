<?php

namespace App\Repository;

interface AttendanceRepositoryInterface
{
    public function index();

    public function show($id);

    public function store($request);

    public function edit($id);

    public function attendance();

    public function attendanceReport();

    public function attendanceSearch($request);
//
//    public function update($request);
//
//    public function delete($request);
}
