<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingsRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index_settings(){
        $settings = Setting::orderBy('id', 'desc')->first();
        return view('admin.settings', compact('settings'));
    }

    public function post_settings(SettingsRequest $request){
        $data = [];
        if ($request->has('status')){
            $data = [ 'status' => 'open'];
//            Artisan::call('up');          // Alternate method instead of observer
        }
        else{
            $data = [ 'status' => 'close' ];
//            Artisan::call('down');        // Alternate method instead of observer
        }

        $setting = Setting::orderBy('id', 'desc')->first();
        if ($request->has('logo')){
            if ($setting->logo !== null)
                Storage::delete($setting->logo);
            $extension = pathinfo($request->file('logo')->getClientOriginalName());
            $logo = $request->file('logo')->storeAs('images/logo', 'logo.'.$extension['extension']);
            $data = array_merge($data, ['logo' => $logo]);
        }
        if ($request->has('icon')){
            if ($setting->icon !== null)
                Storage::delete($setting->icon);
            $extension = pathinfo($request->file('icon')->getClientOriginalName());
            $icon = $request->file('icon')->storeAs('images/icon', 'icon.'.$extension['extension']);
            $data = array_merge($data, ['icon' => $icon]);
        }

        $data = array_merge($data, $request->except([
            '_token', 'status', 'icon', 'logo'
        ]));
        Setting::orderBy('id', 'desc')->first()->update($data);
        return redirect()->back()->with(['success' => 'Settings have been updated']);
    }
}
