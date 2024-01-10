<?php

namespace app\Repositories\Interefaces\AdminDashboard;

interface LibraryRepositoryInterface
{
    public function index();

    public function create();

    public function store($request);

    public function edit($id);

    public function update($request);

    public function delete($request);

    public function downloadBook($filename);

    public function viewBook($filename);

}
