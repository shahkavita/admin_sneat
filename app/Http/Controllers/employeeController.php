<?php

namespace App\Http\Controllers;
use App\Models\employee;
use Illuminate\Http\Request;
class employeeController extends Controller
{
    //
    public function index()
    {
        return view ('admin.emplist');
      
    }
    public function getdata()
    {
        $emp=employee::get();
        return response()->json($emp);
    }

    public function showdata(string $id)
    {
        $emp=employee::find($id);
        return response()->json($emp);
    }
   
}
