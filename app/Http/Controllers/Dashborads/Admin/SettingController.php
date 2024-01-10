<?php

namespace App\Http\Controllers\Dashborads\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interefaces\SettingsRepositoryInterface;
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
