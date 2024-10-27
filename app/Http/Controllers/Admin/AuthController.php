<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\Admin;
use App\Mail\Websitemail;
 
class AuthController extends Controller 
    {
    public function __construct()
    {
        // $this->middleware('auth:admin')->only('logout');
        // $this->middleware(['auth:admin' => ['only' => 'logout']]);
        $this->middleware('guest:admin', ['except' => ['logout']]);

    }

    public function loginshow(){
        return view("admin.auth.login");
    }

    public function login(Request $request){
        $request->validate([
            "email" => ["required","email"],
            "password" => ["required"],
        ]);
        $check = $request->all();

        $data=[
            "email" => $check["email"],
            "password" => $check["password"],
            "status" => 1,
        ];

        if(Auth::guard("admin")->attempt($data)){

            return redirect()->route('dashboard');
        }else{
            return redirect()->route('admin.login')->with('error','The email and password is incorrect! please try again!');
        }

    }

    public function forgotshow(){
        return view("admin.auth.forgot-password");
    }

   
    public function forgot(Request $request){
       
        $request->validate([
            "email" => ["required","email"],
        ]);
        
        $admin=Admin::where('email',$request->email)->first();
        if(!$admin){

            return redirect()->back()->with('error','Email is not found');
      
        }
        $token=hash('sha256',time());
        $admin->token=$token;
        $admin->update();

        $reset_link=url('admin/reset/'.$token.'/'.$request->email);
        $subject='Admin Password Reset';
        $message='To reset password, please chick on the below link</br>';
        $message .= "<a href='".$reset_link."'> Click Here </a>";

        \Mail::to($request->email)->send(new Websitemail($subject, $message));

        return redirect()->back()->with('success','We have send a password reset link on your email.
        please check your email, if you do not find the email in your inbox please check span folder');

    }

    public function resetshow($token, $email){
        $admin=Admin::where('email',$email)->where('token',$token)->first();
        if(!$admin){
            return redirect()->route('admin.login')->with('error','Invalid Link');
        }
        return view("admin.auth.reset-password",compact('token','email'));
    }
    public function reset(Request $request, $token, $email){
        $request->validate([
            "password" => ["required"],
            "confirm_password" => ["required","same:password"],
        ]);

        $admin=Admin::where('email',$request->email)->where('token',$request->token)->first();
        if(!$admin){
            return redirect()->route('admin.login')->with('error','Invalid Link');
        }
        $admin->password=Hash::make($request->password);
        $admin->token='';
        $admin->update();

        return redirect()->route('admin.login')->with('success','Password reset successful. You can login Now.');

    }


    public function logout(){
      
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success','Logout is successful!');
        // return redirect()->route('admin.login');

    }
}
