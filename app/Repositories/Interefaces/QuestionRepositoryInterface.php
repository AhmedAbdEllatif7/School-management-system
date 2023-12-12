<?php

namespace App\Repositories\Interefaces;


interface QuestionRepositoryInterface {

    public function index();



    public function create();



    public function store($request);


    public function edit($id);



    public function update($request);



    public function destroy($request);


}
