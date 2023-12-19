<?php

namespace App\Http\Controllers\school\admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Repositories\Interefaces\PromotionRepositoryInterface;
use Illuminate\Http\Request;

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

        return $this->promotion->store($request);

    }


    public function getNewClassrooms($id)
    {

        return $this->promotion->getNewClassrooms($id);

    }
    public function getNewSections($id)
    {

        return $this->promotion->getNewSections($id);

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

    public function revertAllPromotions(Request $request)
    {
        return $this->promotion->revertAllPromotions($request);
    }




}
