<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\User;
use App\Mail\Websitemail;

class AuthController extends Controller
{
    public function __construct()
    {
       $this->middleware('guest:web', ['except' => ['logout']]);

    }


    public function loginshow(){
        return view("user.login");
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
        ];

        if(Auth::guard("web")->attempt($data)){

            return redirect()->route('user.dashboard');
        }else{
            return redirect()->route('login')->with('error','The email and password is incorrect! please try again!');
        }

    }
    
    public function logout(){
       Auth::guard('web')->logout();
       return redirect()->route('login')->with('success','Logout is successful!');

    }
}
