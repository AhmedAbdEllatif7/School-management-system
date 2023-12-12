<?php

namespace App\Repositories\Interefaces;

interface SectionRepositoryInterface {
    public function index();
    public function store($request);
    public function update($request);
    public function destroy($request);
    public function getClases($id);
}
