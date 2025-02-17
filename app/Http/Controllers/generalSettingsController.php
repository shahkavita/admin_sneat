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
        ],[
            'logo.image' => 'Logo can be only image.',
            'logo.mimes' => 'Only JPEG, PNG, and JPG formats are allowed.',
            'logo.max' => 'The image must not be larger than 2MB.',
            'favicon.image' => 'Favicon can be only image.',
            'favicon.mimes' => 'Only JPEG, PNG, JPG, and ICO formats are allowed.',
            'favicon.max' => 'The image must not be larger than 1MB.',  
            'settings.companyname.required' => 'Company name field is required.',
            'settings.companyname.string' => 'Only String is allowed.',
            'settings.city.required' => 'Logo field is required.',
            'settings.city.string' => 'Only string is allowed',
            'settings.state.required' => 'State field is required.',
            'settings.state.string' => 'Only string is allowed.',
            'settings.country.required' => 'Country field is required.',
            'settings.country.string' => 'Only string is allowed.',
            'settings.zipcode.required' => 'Zip code field is required.',
            'settings.zipcode.integer' => 'Only Digits are allowed.',
            'settings.zipcode.min' => 'Zip code field must be at least 6.',
            'settings.phonenumber.required' => 'Phone number  field is required.',
            'settings.phonenumber.integer' => 'Phone number  field must be an integer.',
            'settings.phonenumber.min' => 'Phone number  field must be at least 10.',
            'settings.email.required' => 'Email field is required.',
            'settings.email.email' => 'Email field must be a valid mail.',
            'settings.project.required' => 'Project field is required.',
            'settings.project.integer' => 'Project field is required.',
            'settings.globalcustomer.required' => 'Global Customer field is required.',
            'settings.globalcustomer.integer' => 'Global Customer field must be an integer.',
            'settings.experience.required' => 'Experience field is required.',
            'settings.experience.integer' => 'Experience field must be an integer.',
            'settings.client.required' => 'Client field is required.',
            'settings.client.integer' => 'Client field must be an integer.',
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

}
