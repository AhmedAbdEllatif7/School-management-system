<?php

namespace App\Repositories\Interefaces\AdminDashboard;

interface SectionRepositoryInterface {
    public function index();
    public function store($request);
    public function update($request);
    public function destroy($request);
    public function getClases($id);
}
