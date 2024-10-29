@extends('layouts.auth')
@section('content')

<div class="auth-right__inner mx-auto w-100">
    <a href="index.html" class="auth-right__logo">
        <img src="{{ asset('public/assets/images/logo/logo.png') }}" alt="">
    </a>
    <h2 class="mb-8">Forgot Password </h2>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>  
        @endforeach      
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div> 
    @endif


    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div> 
    @endif

    <form action="{{ route('admin.forgot.submit') }}" method="post" id="forgotform">
        @csrf
        
        <div class="mb-24">
            <label for="fname" class="form-label mb-8 h6">Email</label>
            <div class="position-relative">
                <input type="email" name="email"  required="" class="form-control py-11 ps-40" id="fname" placeholder="Type your email">
                <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i class="ph ph-user"></i></span>
            </div>
        </div>
      
        <div class="mb-32 flex-between flex-wrap gap-8">
             <a href="{{ route('admin.login') }}" class="text-main-600 hover-text-decoration-underline text-15 fw-medium">Remember Password?</a>
        </div>
        <button type="submit" id="login" class="btn btn-main rounded-pill w-100">Sign In</button>
        

    </form>
</div>

        

@endsection