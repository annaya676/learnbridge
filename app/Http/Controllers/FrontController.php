<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
   
    public function about(){
        return view("page.about");
    }
}
