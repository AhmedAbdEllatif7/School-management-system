<?php


namespace App\Repositories\Interefaces;

interface GraduationRepositoryInterface{

    public function index();

    public function create();

    public function store($request);

    public function restored($request);

    public function forceDeleteSelected($request);

    public function graduateSelected($request);


}
