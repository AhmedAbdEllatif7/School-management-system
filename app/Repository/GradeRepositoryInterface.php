<?php

namespace App\Repository;

interface GradeRepositoryInterface
{

    public function index();

    public function store($request);


    public function update($request);

    public function delete($request);

    public function deleteSelected($request);

    public function deleteAllGrade($request);

}
