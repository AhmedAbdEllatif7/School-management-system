<?php

namespace app\Repositories\Interefaces\AdminDashboard;

interface ProcessingFeesRepositoryInterface
{
    public function index();

    public function show($id);

    public function store($request);

    public function edit($id);

    public function update($request);

    public function delete($request);
}
