<?php

namespace App\Repository;

interface ClassroomRepositoryInterface {
    public function index();
    public function store($request);
    public function update($request);
    public function destroy($request);
    public function filterClasses($request);
    public function deleteAll($request);
}
