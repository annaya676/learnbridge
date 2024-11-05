@extends('layouts.lms')
@section('content')


<div class="dashboard-body">
    <!-- Breadcrumb Start -->
    <div class="breadcrumb mb-24">
        <ul class="flex-align gap-4">
            <li><a href="{{ route('dashboard') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
            <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
            <li><span class="text-main-600 fw-normal text-15">User</span></li>
        </ul>
    </div>
    <!-- Breadcrumb End -->
                 
    

    <div class="tab-content" id="pills-tabContent">
        <!-- My Details Tab start -->
        <div class="tab-pane fade show active" id="pills-details" role="tabpanel" aria-labelledby="pills-details-tab" tabindex="0">
            <div class="card mt-24">
                <div class="card-header border-bottom">
                    <h4 class="mb-4">Create New User</h4>
                </div>
                <div class="card-body">
                    
                    @include('includes.validation-error')


                    <form id="form-create" action="{{ route('user.store')}}" method="post"  class="needs-validation" novalidate>
                        @csrf
                        <div class="row gy-4">
                           

                            <div class="col-sm-6 col-xs-6">
                                <label for="fname" class="form-label mb-8 h6">Name</label>
                                <input type="text" class="form-control py-11 @error('name') is-invalid @enderror"  value="{{ old('name', '') }}"  name="name" id="fname" placeholder="Enter Name">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            
                 
                            <div class="col-sm-6 col-xs-6">
                                <label for="email" class="form-label mb-8 h6">Email</label>
                                <input type="text"  class="form-control py-11 @error('email') is-invalid @enderror"  value="{{ old('email', '') }}"  name="email" id="email" placeholder="Enter Email">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>

                            <div class="col-sm-6 col-xs-6">
                                <label for="phone" class="form-label mb-8 h6">Phone</label>
                                <input type="number"  class="form-control py-11 @error('phone') is-invalid @enderror"  minlength="10"  maxlength="12" value="{{ old('phone', '') }}"  name="phone" id="phone" placeholder="Enter Phone">
                                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
         
                            <div class="col-sm-6 col-xs-6">
                                <label for="lob" class="form-label mb-8 h6">Course Applicability</label>
                                <select class="form-control py-11 @error('lob_id') is-invalid @enderror" required name="lob_id">
                                    
                                    <option value="">{{ __('Select LOB') }}</option>
                                    @foreach($lobs as $lob)
                                      <option  value="{{ $lob->id }}">{{ $lob->name }}</option>
                                    @endforeach
                                </select>

                                </select>
                                @error('lob_id') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>

                            <div class="col-sm-6 col-xs-6">
                                <label for="designation" class="form-label mb-8 h6">Designation</label>
                                <input type="text" class="form-control py-11 @error('designation') is-invalid @enderror"  value="{{ old('designation', '') }}"  name="designation" id="designation" placeholder="Enter Designation">
                                @error('designation') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            
                 
                            <div class="col-sm-6 col-xs-6">
                                <label for="grade" class="form-label mb-8 h6">Grade</label>
                                <input type="text" class="form-control py-11 @error('grade') is-invalid @enderror"  value="{{ old('grade', '') }}"  name="grade" id="grade" placeholder="Enter Grade">
                                @error('grade') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            
                 
                            <div class="col-sm-6 col-xs-6">
                                <label for="doj" class="form-label mb-8 h6">Date of Joining</label>
                                <input type="date" class="form-control py-11 @error('doj') is-invalid @enderror"  min="{{ date('Y-m-d') }}"  value="{{ old('doj', '') }}"  name="doj" id="doj" placeholder="">
                                @error('doj') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            
                 
                            <div class="col-sm-6 col-xs-6">
                                <label for="gender" class="form-label mb-8 h6">Gender</label>
                                <input type="text" class="form-control py-11 @error('gender') is-invalid @enderror"  value="{{ old('gender', '') }}"  name="gender" id="gender" placeholder="Enter Gender">
                                @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="sub_lob" class="form-label mb-8 h6">Sub Lob</label>
                                <input type="text" class="form-control py-11 @error('sub_lob') is-invalid @enderror"  value="{{ old('sub_lob', '') }}"  name="sub_lob" id="sub_lob" placeholder="Enter Sub Lob">
                                @error('sub_lob') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="college_name" class="form-label mb-8 h6">College Name</label>
                                <input type="text" class="form-control py-11 @error('college_name') is-invalid @enderror"  value="{{ old('college_name', '') }}"  name="college_name" id="college_name" placeholder="Enter College Name">
                                @error('college_name') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="location" class="form-label mb-8 h6">Location</label>
                                <input type="text" class="form-control py-11 @error('location') is-invalid @enderror"  value="{{ old('location', '') }}"  name="location" id="location" placeholder="Enter Location">
                                @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="specialization" class="form-label mb-8 h6">Specialization</label>
                                <input type="text" class="form-control py-11 @error('specialization') is-invalid @enderror"  value="{{ old('specialization', '') }}"  name="specialization" id="specialization" placeholder="Enter Specialization">
                                @error('specialization') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="college_location" class="form-label mb-8 h6">College Location</label>
                                <input type="text" class="form-control py-11 @error('college_location') is-invalid @enderror"  value="{{ old('college_location', '') }}"  name="college_location" id="college_location" placeholder="Enter College Location">
                                @error('college_location') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="offer_release_spoc" class="form-label mb-8 h6">Offer Release Spoc</label>
                                <input type="text" class="form-control py-11 @error('offer_release_spoc') is-invalid @enderror"  value="{{ old('offer_release_spoc', '') }}"  name="offer_release_spoc" id="offer_release_spoc" placeholder="Enter Offer Release Spoc">
                                @error('offer_release_spoc') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="trf" class="form-label mb-8 h6">TRF</label>
                                <input type="text" class="form-control py-11 @error('trf') is-invalid @enderror"  value="{{ old('trf', '') }}"  name="trf" id="trf" placeholder="Enter TRF">
                                @error('trf') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                                      
                            <div class="col-sm-6 col-xs-6">
                                <label for="joiner_status" class="form-label mb-8 h6">Joiner Status</label>
                                <input type="text" class="form-control py-11 @error('joiner_status') is-invalid @enderror"  value="{{ old('joiner_status', '') }}"  name="joiner_status" id="joiner_status" placeholder="Enter Joiner Status">
                                @error('joiner_status') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            
                            
                 
                 
                            <div class="col-12">
                                <div class="flex-align justify-content-end gap-8">
                                    <button type="submit" class="btn btn-main rounded-pill py-9">Save  Changes</button>
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