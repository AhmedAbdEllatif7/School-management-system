<?php

namespace App\Http\Controllers\Dashboards\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PromotionRequest;
use App\Repositories\Interefaces\AdminDashboard\PromotionRepositoryInterface;
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


    public function store(PromotionRequest $request)
    {
        return $this->promotion->store($request);
    }



    public function revertAllPromotions(Request $request)
    {
        return $this->promotion->revertAllPromotions($request);
    }


    public function revertSelectedPromotions(Request $request)
    {
        return $this->promotion->revertSelectedPromotions($request);
    }


    public function getNewClassrooms($id)
    {
        return $this->promotion->getNewClassrooms($id);
    }

    public function getNewSections($id)
    {
        return $this->promotion->getNewSections($id);
    }

}
