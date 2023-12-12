<?php

namespace App\Repository;

interface ParentStudentRepositoryInterface
{
    public function index();

    public function show($id);

    public function update($request, $id);

    public function filterAttendances($request);

    public function fees();

    public function receiptStudent($id);

    public function profile();

    public function getAttendance();

}
