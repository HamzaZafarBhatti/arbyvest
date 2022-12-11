<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Image;

class SettingController extends Controller
{
    //
    public function settings()
    {
        return view('admin.settings.basic-setting');
    }
    public function settings_update(Request $request)
    {
        try {
            $setting = Setting::first();
            $data = $request->except('_method', '_token');
            cache()->forget('set');
            $setting->update($data);
            return redirect()->route('admin.settings.index')->with('success', 'Settings updated!');
        } catch (\Throwable $th) {
            Log::error('Error: ' . $th->getMessage());
            return back()->with('error', 'Something went wrong');
        }
    }
    public function update_logo_favicon(Request $request)
    {
        try {
            $setting = Setting::first();
            if ($image = $request->file('logo')) {
                $filename = 'logo_' . time() . '.jpg';
                $location =  $setting->getLogoPath() . $filename;
                Image::make($image)->save($location);
                $data['logo'] = $filename;
            }
            if ($image = $request->file('favicon')) {
                $filename = 'favicon_' . time() . '.jpg';
                $location =  $setting->getFaviconPath() . $filename;
                Image::make($image)->save($location);
                $data['favicon'] = $filename;
            }
            if($setting->logo) {
                unlink($setting->getLogoPath() . $setting->logo);
            }
            if($setting->favicon) {
                unlink($setting->getFaviconPath() . $setting->favicon);
            }
            $setting->update($data);

            return redirect()->route('admin.settings.index')->with('success', 'Images updated!');
        } catch (\Throwable $th) {
            Log::error('Error: ' . $th->getMessage());
            return back()->with('error', 'Something went wrong');
        }
    }
}
