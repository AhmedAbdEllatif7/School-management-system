<?php


namespace App\Repository;

interface GraduationRepositoryInterface{

    public function index();

    public function create();

    public function store($request);


    public function returnAllGraduatedBack();

    public function returnStudent($request);

    public function forceDelete($request);

    public function graduateSelectes($request);
}
