<?php

namespace App\Http\Controllers;
use App\Models\smtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class smtpController extends Controller
{
    //
    public function fetchsmtp()
    {
        $smtp=smtp::all();
        return $smtp;
    }
    public function testsmtp(Request $request)
    {

        $request->validate([
            'sendemail'=>'required|email'
        ]);
        setsmtpConfig();
        try {
            // Send a test email
            Mail::raw('This is a test email to verify SMTP settings.', function ($message) use ($request) {
                $message->to($request->sendemail)
                        ->subject('SMTP Test Email');
            });
            return response()->json(['message' => 'Test email sent successfully!'], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to send test email. Error: ' . $e->getMessage()], 500);
        }
    }
    public function updatesmtp(Request $request)
    {
        $request->validate([
            'mailengine'=>'required',
            'emailprotocol'=>'required',
            'encryption'=>'required',
            'host'=>'required|string',
            'port'=>'required|integer|min:1',
            'email'=>'required|email',
            'username'=>'required|string',
            'password'=>'required|string|min:8',
            'charset'=>'required',
        ]);
        $settings=[
            'mailengine'=>$request->mailengine,
            'emailprotocol'=>$request->emailprotocol,
            'encryption'=>$request->encryption,
            'host'=>$request->host,
            'port'=>$request->port,
            'email'=>$request->email,
            'username'=>$request->username,
            'password'=>$request->password,
            'charset'=>$request->charset,
        ];
        foreach ($settings as $key => $value) {
            smtp::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return response()->json(['message' => 'SMTP settings saved successfully']);
  
    }
}
