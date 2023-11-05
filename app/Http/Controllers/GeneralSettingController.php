<?php

namespace App\Http\Controllers;
use App\Models\GeneralSetting;

use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{
   public function GeneralSetting()
    {
     $data = GeneralSetting::first();
     return view('settings.general_setting',compact('data'));
    }
    public function updateSetting(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('logo')) {
            $logo = 'general_setting' . '.' . time() . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path('img'), $logo);
            $data['logo'] = $logo;
        }
            if ($request->hasFile('favicon')) {
            $favicon = 'general_setting' . '.' . time() . '.' . $request->file('favicon')->getClientOriginalExtension();
            $request->file('favicon')->move(public_path('img'), $favicon);
            $data['favicon'] = $favicon;
        }
            $general_setting = GeneralSetting::first();;
        if ($general_setting) {
            $is_updated = $general_setting->update($data);
            return back()->with(['success' => 'General Setting has been updated!']);
        } else {
            $is_created = $general_setting::create($data);
            return back()->with(['success' => 'General Setting has been added!']);
        }

    }
}
