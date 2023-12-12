<?php

namespace App\Repositories\Interefaces;


interface PromotionRepositoryInterface {

    public function index();

    public function create();

    public function storePromotion($request);

    public function deleteAllPromotion($request);

}
