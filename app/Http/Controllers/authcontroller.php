<?php

namespace App\Http\Controllers;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;

class authcontroller extends Controller
{
    //
    public function login()
    {
        return view('admin.auth.login');
    }
    public function index()
    {
        return view('admin.index');
    }
    public function register()
    {
        return view('admin.auth.register');
    }
    public function forgotpassword()
    {
        return view('admin.auth.forgotpassword');
    }
    public function logout()
    {
        Auth::logout(); // Logs out the user
        return redirect('/'); // Redirects to the homepage or another route
    }
    public function registeruser(Request $request)
    {
        
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);
      /* echo '<pre>';
        print_r($request->all());
        die;*/  
        // Store user with hashed password
        $user =user::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), // Hash the password
            'remember_token'=>$request['_token'],
        ]);
        /*echo '<pre>';
        print_r($user);
        die;*/
        return response()->json(
            ['success' => 'Register successful', 
            'redirect_url' => route('login') ]);
        
    }
    
    public function loginuser(Request $request)
    {
        
        
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
    
        $credentials = $request->only('email','password');
      
        if(Auth::attempt($credentials)) {
            // Authentication passed
           // $request->session()->regenerate();
           return response()->json(['success' => 'Login successful', 'redirect_url' => route('dashboard')]);
        }
        else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials.',
            ], 401); // 401 Unauthorized if login fails
        }
       
    }       
    public function forgotuser(Request $request)
    {
       /* echo '<pre>';
        print_r($request->all());
        die;*/
        
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'We can’t find a user with that email address.',
        ]);
        $status = Password::sendResetLink(
            $request->only('email')
        );
        
       // return response()->json($status);
        if ($status === Password::RESET_LINK_SENT) {
            return response()->json([
                'message' => 'Password reset link sent successfully!',
                'status' => true,
            ]);
        }

        return response()->json([
            'message' => 'Failed to send password reset link.',
            'status' => false,
        ]);
    }
    /*public function create(Request $request, $token)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }*/
    public function reset(Request $request, $token)
    {
        return view('admin.auth.resetpassword',['token' => $token, 'email' => $request->email]);
    }
    public function updatepassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required',
        ]);
    
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );
    
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
    
    public function resetpass(Request $request)
    {  
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'We can’t find a user with that email address.',
        ]);
        $status = Password::sendResetLink(
            $request->only('email')
        );
        if ($status === Password::RESET_LINK_SENT) {
            return response()->json([
                'message' => 'Password reset link sent successfully!',
                'status' => true,
            ]);
        }
        return response()->json([
            'message' => 'Failed to send password reset link.',
            'status' => false,
        ]);
    }
}
