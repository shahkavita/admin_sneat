<?php

namespace App\Http\Controllers;
use App\Models\generalSettings;
use Illuminate\Http\Request;

class generalSettingsController extends Controller
{
    //
    public function fetchsettings()
    {
        $settings=generalSettings::all();
        return response()->json($settings);
    }
    public function updatesettings(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,ico|max:1024',
            'settings.companyname' => 'required|string',
            'settings.city' => 'required|string',
            'settings.state' => 'required|string',
            'settings.country' => 'required|string',
            'settings.zipcode' => 'required|integer|min:6',
            'settings.phonenumber' => 'required|integer|min:10',
            'settings.email' => 'required|email',
            'settings.project' => 'required|integer',
            'settings.globalcustomer' => 'required|integer',
            'settings.experience' => 'required|integer',
            'settings.client' => 'required|integer',
        ]);

        foreach ($request->settings as $key => $value) {
            generalSettings::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            generalSettings::updateOrCreate(['key' => 'logo'], ['value' => $logoPath]);
        }

        if ($request->hasFile('favicon')) {
            $faviconPath = $request->file('favicon')->store('favicons', 'public');
            generalSettings::updateOrCreate(['key' => 'favicon'], ['value' => $faviconPath]);
        }
        return response()->json(['success' => true, 'message' => 'General Settings Saved successfully']);
    }
    public function getSetting($key) {
        $setting = generalSettings::where('key', $key)->first();
        if ($setting) {
            return response()->json($setting);
        }
        return response()->json(['success' => false, 'message' => 'Setting not found!'], 404);
    }

}
