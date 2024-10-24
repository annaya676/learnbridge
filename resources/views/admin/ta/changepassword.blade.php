@extends('layouts.lms')
@section('content')


<div class="dashboard-body">
    <!-- Breadcrumb Start -->
    <div class="breadcrumb mb-24">
        <ul class="flex-align gap-4">
            <li><a href="{{ route('dashboard') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
            <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
            <li><span class="text-main-600 fw-normal text-15">TA</span></li>
        </ul>
    </div>
    <!-- Breadcrumb End -->
                 
    

    <div class="tab-content" id="pills-tabContent">
        <!-- My Details Tab start -->
        <div class="tab-pane fade show active" id="pills-details" role="tabpanel" aria-labelledby="pills-details-tab" tabindex="0">
            <div class="card mt-24">
                <div class="card-header border-bottom">
                    <h4 class="mb-4">Change Password</h4>
                </div>
                <div class="card-body">
                    
                    @include('includes.validation-error')


                    <form id="form-create" action="{{ route('ta.updatepassword', $sme->id)}}" method="post"  class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row gy-4">
                            <div class="col-sm-6 col-xs-6">
                                <label for="new-password" class="form-label mb-8 h6">New Password</label>
                                    <input type="text"  name="password" required class="form-control py-11  @error('password') is-invalid @enderror" id="new-password" placeholder="Enter New Password">
                                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="confirm_password" class="form-label mb-8 h6">Confirm Password</label>
                                    <input type="text"  name="confirm_password" required class="form-control py-11  @error('confirm_password') is-invalid @enderror" id="confirm_password" placeholder="Enter Confirm Password">
                                    @error('confirm_password') <div class="invalid-feedback">{{ $message }}</div> @enderror  
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
        <!-- My Details Tab End -->
        
    </div>


    
</div>


   
@endsection