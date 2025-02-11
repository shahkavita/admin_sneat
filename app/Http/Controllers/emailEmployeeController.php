<?php

namespace App\Http\Controllers;
use App\Models\emailtoemployee;
use App\Models\employee;
use App\Mail\EmployeeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class emailEmployeeController extends Controller
{
    //
    public function index()
    {
        return view('admin.emailEmployee.index');
    }
    public function senddata(Request $request)
    {
       
       // return $employee;
       $request->validate([
            'subject'=>'required|string',
            'message'=>'required|string'
       ]);
       $employee=employee::where('status',1)->get();
       
       
       foreach($employee as $emp)
       {
          Mail::to($emp->email)->send(new EmployeeMail($request->subject, $request->message));
       }
        emailtoemployee::create([
            'message'=>$request->message,
            'subject'=>$request->subject,
        ]);
        return response()->json(['success' => true, 'message' => 'Emails send successfully!']);
    }
}
