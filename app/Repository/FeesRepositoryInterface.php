<?php

namespace App\Repository;

use App\Models\Grade;

interface FeesRepositoryInterface
{
    public function index();

    public function create();

    public function storeFees($request);

    public function editFees($fee_id);

    public function updateFees($request);

    public function deleteFees($request);



//
//
//    public function storeFees($request);


}
