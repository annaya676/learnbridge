@extends('layouts.auth')
@section('content')

<div class="auth-right__inner mx-auto w-100">
	<a href="index.html" class="auth-right__logo">
        <img src="{{ asset('public/assets/images/logo/logo.png') }}" alt="">
	</a>
	<h2 class="mb-8">Reset Password</h2>

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

	<form  action="{{ route('admin.reset.submit',[ $token, $email]) }}" method="post" id="forgotform">
		@csrf
		
		<div class="mb-24">
			<label for="new-password" class="form-label mb-8 h6">Password</label>
			<div class="position-relative">
				<input type="password"  name="password" required="" class="form-control py-11 ps-40" id="new-password" placeholder="Enter New Password">
				<span class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash" id="#new-password"></span>
				<span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i class="ph ph-lock"></i></span>
			</div>
		</div>
		<div class="mb-24">
			<label for="confirm_password" class="form-label mb-8 h6">Password</label>
			<div class="position-relative">
				<input type="password"  name="confirm_password" required="" class="form-control py-11 ps-40" id="confirm_password" placeholder="Enter Confirm Password">
				<span class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash" id="#confirm_password"></span>
				<span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i class="ph ph-lock"></i></span>
			</div>
		</div>

		<div class="mb-32 flex-between flex-wrap gap-8">
			Go back to <a href="{{ route('admin.login') }}" class="text-main-600 hover-text-decoration-underline text-15 fw-medium">Login</a>
		</div>
		<button type="submit" id="login" class="btn btn-main rounded-pill w-100">Submit</button>
		

	</form>
</div>


@endsection