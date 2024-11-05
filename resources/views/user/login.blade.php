@extends('layouts.auth')
@section('content')

    <div class="auth-right__inner mx-auto w-100">
        <a href="index.html" class="auth-right__logo">
            <img src="{{ asset('public/assets/images/logo/logo.png') }}" alt="">
        </a>
       
        <h2 class="mb-8">Sign-In to your account </h2>
        <p class="text-gray-600 text-15 mb-32">Welcome to LearnBridge!</p>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
                </div>  
            @endforeach      
        @endif
    
           
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
            </div> 
        @endif
        

        <form action="{{ route('login.submit') }}" method="post" id="loginform">
            @csrf
            
            <div class="mb-24">
                <label for="fname" class="form-label mb-8 h6">Email</label>
                <div class="position-relative">
                    <input type="email" name="email"  required="" class="form-control py-11 ps-40" id="fname" placeholder="Type your email">
                    <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i class="ph ph-user"></i></span>
                </div>
            </div>
            <div class="mb-24">
                <label for="current-password" class="form-label mb-8 h6">Password</label>
                <div class="position-relative">
                    <input type="password"  name="password" required="" class="form-control py-11 ps-40" id="current-password" placeholder="Enter Current Password">
                    <span class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash" id="#current-password"></span>
                    <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i class="ph ph-lock"></i></span>
                </div>
            </div>
          
            <button type="submit" id="login" class="btn btn-main rounded-pill w-100">Sign In</button>
            

        </form>
    </div>

 @endsection