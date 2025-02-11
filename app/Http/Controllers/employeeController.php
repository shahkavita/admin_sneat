<?php

namespace App\Http\Controllers;
use App\Models\employee;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
class employeeController extends Controller
{
    //
    public function index()
    {
        return view ('admin.Employee.index');      
    }
    public function list(Request $request)
    {
       if ($request->ajax()) {
            $data = employee::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('skills', function ($user) {
                    if (!empty($user->skills)) {
                        $skillsArray = is_array($user->skills) ? $user->skills : explode(',', $user->skills);
                        return implode('<br>', $skillsArray); // Display each skill on a new line
                    }
                    return '-';
                })
                ->addColumn('status', function($row){
                if($row->status == 0)
                   {
                    return "<span class='badge bg-label-danger me-1'>InActive</span>";
                   } 
                   else
                   {
                    return "<span class='badge bg-label-primary me-1'>Active</span>";
                   }
                })
                ->addColumn('action', function ($row) {
                return '<button class="edit btn btn-primary btn-sm"  onclick="viewemployee('.$row->id.')"><i class="fas fa-eye"></i></button>
                        <button class="edit btn btn-info btn-sm"  onclick="editemployee('.$row->id.')"><i class="fas fa-edit"></i></button>
                        <button class="delete btn btn-danger btn-sm" onclick="deleteemployee('.$row->id.')"><i class="fa fa-trash" aria-hidden="true"></i>
            </button>';
                })
                ->rawColumns(['skills','status','action'])
                ->make(true);
            }
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
                    "status" => isset($post['status']) ? $post['status'] : "",
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
                'status' => $request->status,
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
