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
    public function savedata(Request $request)
    {
       /*  $validatedData = $request->validated();
        employee::create([
            'name'=>$validatedData->name,
            'email'=> $validatedData->email,
            'gender'=> $validatedData->gender,
            'department'=> $validatedData->department,
            'skills'=>implode(',',$validatedData->skills),
        ]);*/
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employee,email',
            'gender'=>'required',
            'department'=>'required',
            'skills' => 'required', // Comma-separated validation
        ],
        [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please provide a valid email address.',
            'gender.required' => 'The gender field is required.',
            'department.required' => 'The department field is required.',
            'email.unique' => 'This email is already registered.',
            'skills.required' => 'The skills field is required.',
        ]);
        employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'department' => $request->department,
            'skills' => implode(',',$request->skills),
        ]);
        return response()->json(['success' => true, 'message' => 'Employee created successfully!']);
    }
    public function showdata(string $id)
    {
        $emp=employee::find($id);
        return response()->json($emp);
    }
   
}
