<?php

namespace App\Repositories\Interefaces\AdminDashboard;

interface ClassroomRepositoryInterface {
    
    public function index();

    public function store($request);

    public function checkIfNameExists($listClasses);

    public function createNewClasses($listClasses);

    public function update($request);

    public function destroy($request);

    public function filterClasses($request);

    public function deleteSelectedClassrooms($request);

}
