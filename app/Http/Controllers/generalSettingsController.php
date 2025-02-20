<?php

namespace App\Http\Controllers;
use App\Models\generalSettings;
use Illuminate\Http\Request;
use App\Models\city;
use App\Models\state;
class generalSettingsController extends Controller
{
    //
    public function fetchsettings()
    {
        $settings=generalSettings::all();
        $country=getcountry();
        $state=state::get();
        $city=city::get();
        return response()->json([
            'settings'=>$settings,
            'country'=>$country,
            'state'=>$state,
            'city'=>$city
        ]);
    }
    public function getcity($state_id)
    {
        $city=getcityByState($state_id);
        return response()->json($city);
    }

    public function getstate($country_id)
    {
        $state=getstateByCountry($country_id);
        return response()->json($state);
    }
    public function updatesettings(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,ico|max:1024',
            'settings.companyname' => 'required|regex:/^[a-zA-Z\s]+$/',
            'settings.city' => 'required',
            'settings.state' => 'required',
            'settings.country' => 'required',
            'settings.zipcode' => 'required|digits:6',
            'settings.phonenumber' => 'required|digits:10',
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
            'settings.companyname.regex' => 'Comapny name can not contain numbers.',
            'settings.city.required' => 'Logo field is required.',
            'settings.state.required' => 'State field is required.',
            'settings.country.required' => 'Country field is required.',
            'settings.zipcode.required' => 'Zip code field is required.',
            'settings.zipcode.digits' => 'Zip code must be exactly 6 digits.',
            'settings.phonenumber.required' => 'Phone number  field is required.',
            'settings.phonenumber.digits' => 'Phone number must be exactly 10 digits',  
            'settings.email.required' => 'Email field is required.',
            'settings.email.email' => 'Email field must be a valid mail.',
            'settings.project.required' => 'Project field is required.',
            'settings.project.integer' => 'Project field must be a valid number.',
            'settings.globalcustomer.required' => 'Global Customer field is required.',
            'settings.globalcustomer.integer' => 'Global Customer must be a valid number.',
            'settings.experience.required' => 'Experience field is required.',
            'settings.experience.integer' => 'Experience field must be a valid number.',
            'settings.client.required' => 'Client field is required.',
            'settings.client.integer' => 'Client field must be a valid number.',
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
