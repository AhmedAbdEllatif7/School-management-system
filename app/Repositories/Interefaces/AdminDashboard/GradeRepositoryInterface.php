<?php

namespace App\Repositories\Interefaces\AdminDashboard;

interface GradeRepositoryInterface
{

    public function index();

    public function store($request);

    public function uniqueStoreValidation($listGrades);

    public function uniqueUpdateValidation($request);

    public function update($request);

    public function delete($request);

    public function deleteSelectedGrades($request);

}
