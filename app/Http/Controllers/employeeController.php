<?php

namespace App\Http\Controllers;
use App\Models\employee;
use Illuminate\Http\Request;
class employeeController extends Controller
{
    //
    public function index()
    {
        return view ('admin.employee.index');
      
    }
    public function getdata()
    {
        $s1=employee::get();
        return response()->json($s1);
    }
   
}
