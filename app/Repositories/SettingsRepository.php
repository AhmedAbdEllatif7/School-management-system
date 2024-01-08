<?php

namespace App\Repositories;

use App\Models\Setting;
use App\Repositories\Interefaces\SettingsRepositoryInterface;
use App\Traits\AttachFilesTrait;

class SettingsRepository implements SettingsRepositoryInterface
{

    use AttachFilesTrait;

    public function index(){

        $settings = Setting::all()->pluck('value', 'key')->toArray();

        return view('pages.adminDashboard.settings.index', compact('settings'));
    }

    
    public function update($request)
    {
        try {
            $settingsData = $request->get('settings');

            if ($request->hasFile('logo')) {
                $oldLogo = Setting::where('key', 'logo')->first();
                if ($oldLogo) {
                    $this->deleteFile('logo/' . $oldLogo->value);
                }
                
                $logoPath = $this->uploadLogo($request);
                $settingsData['logo'] = $logoPath;
            }

            // Update or create settings based on the submitted data
            foreach ($settingsData as $key => $value) {
                Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            }

            return redirect()->route('settings.index')->with(['success' => 'Settings updated successfully']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    private function uploadLogo($request)
    {
        $newFileName = $this->uploadFile($request, 'logo', 'logo');
        return $newFileName;
    }


}
