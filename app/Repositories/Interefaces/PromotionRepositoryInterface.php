<?php

namespace App\Repositories\Interefaces;


interface PromotionRepositoryInterface {

    public function index();

    public function create();

    public function store($request);

    public function deleteAllPromotion($request);

    public function getNewClassrooms($id);

    public function getNewSections($id);

}
