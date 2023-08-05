<?php

namespace App\Http\Controllers\school;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\Student;
use App\Repository\PromotionRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller
{
    protected $promotion;
    public function __construct(PromotionRepositoryInterface $promotion)
    {
        $this->promotion = $promotion;

    }
    public function index()
    {
        return $this->promotion->index();
    }


    public function create()
    {
        return $this->promotion->create();
    }


    public function store(Request $request)
    {

        return $this->promotion->storePromotion($request);

    }





    public function show(Promotion $promotion)
    {
        //
    }

    public function edit(Promotion $promotion)
    {
        //
    }

    public function update(Request $request, Promotion $promotion)
    {
        //
    }

    public function destroy(Promotion $promotion)
    {
        //
    }

    public function deleteAll(Request $request)
    {
        return $this->promotion->deleteAllPromotion($request);
    }




}
