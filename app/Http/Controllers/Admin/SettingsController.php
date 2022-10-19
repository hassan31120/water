<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $setting = Setting::find(1);
        return view('admin.settings.index', compact('setting'));
    }

    public function edit($id)
    {
        $setting = Setting::find($id);
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $setting = Setting::find($id);
        $request->validate([
            'about'     => 'required',
            'contact'   => 'required',
            'terms'     => 'required',
            'privacy'   => 'required'
        ]);

        $data = $request->all();

        $setting->update($data);
        return redirect()->back()->with('success', 'تم تعديل الإعدادات بنجاح');
    }
}
