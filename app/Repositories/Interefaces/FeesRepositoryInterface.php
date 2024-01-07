<?php

namespace App\Repositories\Interefaces;

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
