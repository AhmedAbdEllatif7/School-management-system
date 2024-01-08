<?php

namespace App\Repositories\Interefaces;

interface AttendanceRepositoryInterface
{
    public function index();

    public function show($id);

    public function store($request);

}
