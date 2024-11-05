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
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>

            </div>  
        @endforeach      
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
        </div> 
    @endif


    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
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
      
        <button type="submit" id="login" class="btn btn-main rounded-pill w-100">Next</button>
        <a href="{{ route('admin.login') }}" class="my-32 text-main-600 flex-align gap-8 justify-content-center"> <i class="ph ph-arrow-left d-flex"></i> Back To Login</a>
    </form>
</div>

        

@endsection