<?php

namespace App\Http\Controllers;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
    
}
