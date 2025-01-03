<?php

namespace App\Http\Controllers;
use App\Models\employee;

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
            // Create a new employee
            $post = $request->post();
            $id=$request['hid'];
            if($request['hid']!="")
            {
                $request->validate([
                    'name' => 'required',
                    'email' => 'required|email',
                    'gender' => 'required',
                    'department' => 'required',
                    'skills' => 'required|array', // Ensure skills is an array
                ], [
                    'name.required' => 'The name field is required.',
                    'email.required' => 'The email field is required.',
                    'email.email' => 'Please provide a valid email address.',
                    'gender.required' => 'The gender field is required.',
                    'department.required' => 'The department field is required.',
                    'email.unique' => 'This email is already registered.',
                    'skills.required' => 'The skills field is required.',
                ]);   
                $update_about =  employee::where("id", $id);
                $update_data = [
                    "name" => isset($post['name']) ? $post['name'] : "",
                    "email" => isset($post['email']) ? $post['email'] : "",
                    "gender" => isset($post['gender']) ? $post['gender'] : "",
                    "department" => isset($post['department']) ? $post['department'] : "",
                    "skills" => isset($post['skills']) ? implode(',', $post['skills']) : "",
                ];
                $update_about->update($update_data);
                return response()->json(['success' => true, 'message' => 'Employee updated successfully!']);
                 
            }
        else{
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'gender' => 'required',
                'department' => 'required',
                'skills' => 'required|array', // Ensure skills is an array
            ], [
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
                'skills' =>implode(",",$request->skills),
            ]);
            return response()->json(['success' => true, 'message' => 'Employee created successfully!']);
        }
    }
    public function viewdata(string $id)
    {
        $employee=employee::find($id);
        return response()->json($employee);
    }
    public function deletedata(string $id)
    {
        $employee=employee::find($id);
        $employee->delete();
        return response()->json(['success' => true, 'message' => 'Employee deleted successfully!']);
    }
    public function data(string $id)
    {  
        $employee=employee::find($id);
        return response()->json($employee);
    }
       
}  
