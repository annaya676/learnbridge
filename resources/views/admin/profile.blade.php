@extends('layouts.lms')
@section('content')


<div class="dashboard-body">
    <!-- Breadcrumb Start -->
    <div class="breadcrumb mb-24">
        <ul class="flex-align gap-4">
            <li><a href="{{ route('dashboard') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
            <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
            <li><span class="text-main-600 fw-normal text-15">Setting</span></li>
        </ul>
    </div>
    <!-- Breadcrumb End -->
            
    @include('includes.validation-error')


    <div class="card overflow-hidden">
        <div class="card-body p-0">
           

            <div class="setting-profile px-24" style="margin-top: 0px;">
                <div class="flex-between">
                    <div class="d-flex align-items-end flex-wrap mb-32 gap-24">
                        <img src="{{ asset('public/assets/images/user.png') }}" alt="" class="w-120 h-120 rounded-circle border border-white">
                        <div>
                            <h4 class="mb-8">{{ ucwords($data->name) }}</h4>
                            <div class="setting-profile__infos flex-align flex-wrap gap-16">
                                <div class="flex-align gap-6">
                                    <span class="text-gray-600 d-flex text-lg"><i class="ph ph-swatches"></i></span>
                                    <span class="text-gray-600 d-flex text-15">{{ $data->role_id==1?'Admin':'SME' }}</span>
                                </div>
                                <div class="flex-align gap-6">
                                    <span class="text-gray-600 d-flex text-lg"><i class="ph ph-calendar-dots"></i></span>
                                    <span class="text-gray-600 d-flex text-15">Join {{ $data->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="nav common-tab style-two nav-pills mb-0" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('profile')}}" class="nav-link {{ $slug==''?'active':''}}" >My Details</a>
                    </li>
                 
                    <li class="nav-item" role="presentation">
                      <a href="{{ route('profile.changepassword','change-password')}}" class="nav-link {{ $slug=='change-password'?'active':''}}" id="pills-password-tab" >Password</a>
                    </li>
                 
                </ul>
            </div>

        </div>
    </div>


    <div class="tab-content" id="pills-tabContent">
        <!-- My Details Tab start -->
        <div class="tab-pane fade {{ $slug==''?'show active':''}}" id="pills-details" role="tabpanel" aria-labelledby="pills-details-tab" tabindex="0">
            <div class="card mt-24">
                <div class="card-header border-bottom">
                    <h4 class="mb-4">My Details</h4>
                    <p class="text-gray-600 text-15">Please fill full details about yourself</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.submit')}}" method="post"  class="needs-validation" novalidate>
                        @csrf
                        <div class="row gy-4">
                            <div class="col-12 col-sm-7">
                                <label for="fname" class="form-label mb-8 h6">Name</label>
                                <input type="text" class="form-control py-11 @error('name') is-invalid @enderror" name="name" value="{{ $data->name }}" id="fname" placeholder="Enter Name">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror  
  
                            </div>
                            
                            <div class="col-12 col-sm-7">
                                <label for="email" class="form-label mb-8 h6">Email</label>
                                <input type="email" class="form-control py-11 @error('email') is-invalid @enderror" name="email" value="{{ $data->email }}"  id="email" placeholder="Enter Email">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror  

                            </div>
                            <div class="col-12 col-sm-7">
                                <label for="phone" class="form-label mb-8 h6">Phone Number</label>
                                <input type="number" class="form-control py-11 @error('phone') is-invalid @enderror" name="phone" value="{{ $data->phone }}" id="phone" placeholder="Enter Phone Number">
                                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror  
 
                            </div>
                           
                            <div class="col-12">
                                <div class="flex-align justify-content-end gap-8">
                                    <button type="reset" class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9">Cancel</button>
                                    <button type="submit" class="btn btn-main rounded-pill py-9">Save  Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- My Details Tab End -->
        
        <!-- Password Tab Start -->
        <div class="tab-pane fade {{ $slug=='change-password'?'show active':''}}" id="pills-password" role="tabpanel" aria-labelledby="pills-password-tab" tabindex="0">
            <div class="card mt-24">
                <div class="card-header border-bottom">
                    <h4 class="mb-4">Password Settings</h4>
                    <p class="text-gray-600 text-15">Please fill full details about yourself</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.updatepassword')}}" method="post"  class="needs-validation" novalidate>
                        @csrf
                        <div class="row gy-4">
                            <div class="col-12 col-sm-7">
                                <label for="current-password" class="form-label mb-8 h6">Current Password</label>
                                <div class="position-relative">
                                    <input type="password" class="form-control py-11 @error('current_password') is-invalid @enderror" name="current_password" id="current-password" placeholder="Enter Current Password">
                                    <span class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash" id="#current-password"></span>
                                    @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                  
                            </div>
                            <div class="col-12 col-sm-7">
                                <label for="new-password" class="form-label mb-8 h6">New Password</label>
                                <div class="position-relative">
                                    <input type="password" name="new_password" class="form-control py-11 @error('new_password') is-invalid @enderror" id="new-password" placeholder="Enter New Password">
                                    <span class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash" id="#new-password"></span>
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror  
                                </div>
                                 
                            </div>
                            <div class="col-12 col-sm-7">
                                <label for="confirm-password" class="form-label mb-8 h6">Confirm Password</label>
                                <div class="position-relative">
                                    <input type="password" name="confirm_password" class="form-control py-11 @error('confirm_password') is-invalid @enderror" id="confirm-password"  placeholder="Enter Confirm Password">
                                    <span class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash" id="#confirm-password"></span>
                                    @error('confirm_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                   
                            </div>
                            <div class="col-12">
                                <div class="flex-align justify-content-end gap-8">
                                    <button type="reset" class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9">Cancel</button>
                                    <button type="submit" class="btn btn-main rounded-pill py-9">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>                     
                </div>
            </div>
        </div>
        <!-- Password Tab End -->
    </div>
</div>
 
@endsection