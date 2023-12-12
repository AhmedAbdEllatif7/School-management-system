<?php

namespace App\Repositories\Interefaces;

interface LibraryRepositoryInterface
{
    public function index();

    public function create();

    public function store($request);

    public function edit($id);

    public function update($request);

    public function delete($request);

    public function download($filename);

    public function viewFile($filename);

}
