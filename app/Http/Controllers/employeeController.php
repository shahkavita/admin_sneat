<?php

namespace App\Http\Controllers;
use App\Models\employee;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Http\Request;
class employeeController extends Controller
{
    //
    public function index()
    {
        return view ('admin.Employee.index');
      
    }
    public function getdata()
    {
        $emp=employee::get();
        return response()->json($emp);
    }
    public function savedata(EmployeeRequest $request)
    {
       
        $validatedData = $request->validated();
        employee::create([
            'name'=>$validatedData->name,
            'email'=> $validatedData->email,
            'gender'=> $validatedData->gender,
            'department'=> $validatedData->department,
            'skills'=>implode(',',$validatedData->skills),
        ]);
        return response()->json(['success' => 'Employee added successfully.']);
       
    }
    public function showdata(string $id)
    {
        $emp=employee::find($id);
        return response()->json($emp);
    }
   
}
