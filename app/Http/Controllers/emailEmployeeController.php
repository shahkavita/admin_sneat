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
       $request->validate([
            'subject'=>'required|string',
            'message'=>'required|string',
           //  'file' => 'nullable|mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx|max:25600'
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx|max:25600'
       ],
        [
        'attachment.max' => 'The attachment field must not be greater than 25MB.', // Custom message
        'attachment.mimes' => 'Only JPG, PNG, GIF, PDF, DOC, DOCX, XLS, and XLSX are allowed.',
        ]);

       $employee=employee::where('status',1)->get();
       $fileFullPath = null;
       if ($request->hasFile('attachment')) {
           $file = $request->file('attachment');
           
           $extension=$file->getClientOriginalExtension();
            if(in_array($extension,['jpg','jpeg','png','gif']))
            {
                $request->validate([
                    'attachment'=>'max:2048',
                ],[
                    'attachment.max' => 'Image size exceeds allowed limit 2MB.', // Custom message
                ]);
            }
            else if(in_array($extension,['pdf','doc','docx','xls','xlsx']))
            {
                $request->validate([
                    'attachment'=>'max:25600',
                ],
                [
                    'attachment.max' => 'File size exceeds allowed limit 25MB.', // Custom message
                ]);
            }
            else
            {
                return response()->json(['error' => 'Invalid file type. Allowed: jpg, jpeg, png, gif, pdf, doc, docx, xls, xlsx'], 422);
    
            }
            $filePath = $file->store('attachments', 'public'); // Store in storage/app/public/attachments
           $fileFullPath = storage_path("app/public/{$filePath}"); // Get full path
       }
        
       $mailData = [
        'message'=>$request->message,
        'subject'=>$request->subject,
    ];

       foreach($employee as $emp)
       {
          Mail::to($emp->email)->send(new EmployeeMail($mailData, $fileFullPath));
       }
        emailtoemployee::create([
            'message'=>$request->message,
            'subject'=>$request->subject,
            'attachment'=>$fileFullPath,
        ]);
        return response()->json(['success' => true, 'message' => 'Emails send successfully!']);
    }
}
