<?php

namespace App\Http\Controllers;
use App\Models\generalSettings;
use Illuminate\Http\Request;

class settingController extends Controller
{
    //
    public function index()
    {
        return view('admin.settings.index');
    }
   
}
