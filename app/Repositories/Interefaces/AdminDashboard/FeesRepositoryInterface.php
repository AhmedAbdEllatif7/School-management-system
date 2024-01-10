<?php

namespace app\Repositories\Interefaces\AdminDashboard;

interface FeesRepositoryInterface
{
    public function index();

    public function create();

    public function store($request);

    public function edit($fee_id);

    public function update($request);

    public function delete($request);



//
//
//    public function storeFees($request);


}
