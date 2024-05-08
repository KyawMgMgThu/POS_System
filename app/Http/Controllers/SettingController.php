<?php

namespace App\Http\Controllers;

use App\Models\ModelsSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //
    public function index()
    {
        return view('settings.edit');
    }
    public function store(Request $request)
    {
        $data = $request->except('_token');
        foreach ($data as $key => $value) {
            $setting = ModelsSetting::firstOrCreate(['key' => $key]);
            $setting->value = $value;
            $setting->save();
        }
        return redirect()->route('settings.index');
    }
}
