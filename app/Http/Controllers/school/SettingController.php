<?php

namespace App\Http\Controllers\school;

use App\Http\Controllers\Controller;
use App\Repository\SettingsRepositoryInterface;
use Hamcrest\Core\SetTest;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected $setting;
    public function __construct(SettingsRepositoryInterface $setting)
    {
        $this->setting = $setting;
    }

    public function index()
    {
        return $this->setting->index();
    }

    public function update(Request $request)
    {
        return $this->setting->update($request);
    }
}
