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
                    <h4 class="mb-4">Edit User</h4>
                </div>
                <div class="card-body">
                    
                    
                    @include('includes.validation-error')


                    <form id="form-create" action="{{ route('user.update', $user->id)}}" method="post"  class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row gy-4">
                           

                            <div class="col-sm-6 col-xs-6">
                                <label for="fname" class="form-label mb-8 h6">Name</label>
                                <input type="text" value="{{ $user->name }}" class="form-control py-11 @error('name') is-invalid @enderror"   name="name" id="fname" placeholder="Enter Name">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>

                            <div class="col-sm-6 col-xs-6">
                                <label for="email" class="form-label mb-8 h6">Email</label>
                                <input type="text" value="{{ $user->email }}" class="form-control py-11 @error('email') is-invalid @enderror"   name="email" id="email" placeholder="Enter Email">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>

                            <div class="col-sm-6 col-xs-6">
                                <label for="phone" class="form-label mb-8 h6">Phone</label>
                                <input type="number" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 12)"  value="{{ $user->phone }}" class="form-control py-11 @error('phone') is-invalid @enderror"   minlength="10"  maxlength="12"  name="phone" id="phone" placeholder="Enter Phone">
                                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
         
                            <div class="col-sm-6 col-xs-6">
                                <label for="lob" class="form-label mb-8 h6">Course Applicability</label>
                                <select class="form-control py-11 @error('lob_id') is-invalid @enderror" required name="lob_id">
                                    
                                    <option value="">{{ __('Select LOB') }}</option>
                                    @foreach($lobs as $lob)
                                      <option  value="{{ $lob->id }}" {{ $user->lob_id==$lob->id?'selected':'' }} >{{ $lob->name }}</option>
                                    @endforeach
                                </select>

                                </select>
                                @error('lob_id') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>

                           

                            <div class="col-sm-6 col-xs-6">
                                <label for="designation" class="form-label mb-8 h6">Designation</label>
                                <select class="form-control py-11 @error('designation') is-invalid @enderror" required name="designation">
                                    <option  value="">{{ __('Select Designation') }}</option>
                                    <option {{ $user->designation == "Junior Analyst" ? 'selected' : '' }} value="Junior Analyst">Junior Analyst</option>
                                    <option {{ $user->designation == "Junior Associate" ? 'selected' : '' }} value="Junior Associate">Junior Associate</option>
                                    <option {{ $user->designation == "Intern" ? 'selected' : '' }} value="Intern">Intern</option>
                                    <option {{ $user->designation == "Junior Associate - Design" ? 'selected' : '' }} value="Junior Associate - Design">Junior Associate - Design</option>
                                    <option {{ $user->designation == "Junior Engineer" ? 'selected' : '' }} value="Junior Engineer">Junior Engineer</option>
                                    <option {{ $user->designation == "Junior Sales Support Analyst" ? 'selected' : '' }} value="Junior Sales Support Analyst">Junior Sales Support Analyst</option>
                                </select>
                                @error('designation') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            
                 
                            <div class="col-sm-6 col-xs-6">
                                <label for="level" class="form-label mb-8 h6">Level</label>
                                <select class="form-control py-11 @error('level') is-invalid @enderror" required name="level">
                                    <option  value="">{{ __('Select Level') }}</option>
                                    <option {{ $user->level == "Level 1" ? 'selected' : '' }} value="Level 1">Level 1</option>
                                    <option {{ $user->level == "Level 2" ? 'selected' : '' }} value="Level 2">Level 2</option>
                                    <option {{ $user->level == "Level 3" ? 'selected' : '' }} value="Level 3">Level 3</option>
                                    <option {{ $user->level == "Level 4" ? 'selected' : '' }} value="Level 4">Level 4</option>
                                </select>
                                @error('level') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            
                 
                            <div class="col-sm-6 col-xs-6">
                                <label for="doj" class="form-label mb-8 h6">Date Of Joining</label>
                                <input type="date" class="form-control py-11 @error('doj') is-invalid @enderror" value="{{ $user->doj }}"  min="{{ $user->doj }}" name="doj" id="doj" placeholder="">
                                @error('doj') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            
                 
                            <div class="col-sm-6 col-xs-6">
                                <label for="gender" class="form-label mb-8 h6">Gender</label>
                                <select class="form-control py-11 @error('gender') is-invalid @enderror" required name="gender">
                                    <option  value="">{{ __('Select Gender') }}</option>
                                    <option {{ $user->gender == "Male" ? 'selected' : '' }} value="Male">Male</option>
                                    <option {{ $user->gender == "Female" ? 'selected' : '' }} value="Female">Female</option>
                                    <option {{ $user->gender == "Other" ? 'selected' : '' }} value="Other">Other</option>
                                </select>
                                @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="sub_lob" class="form-label mb-8 h6">Sub Lob</label>
                                <input type="text" class="form-control py-11 @error('sub_lob') is-invalid @enderror"  value="{{ $user->sub_lob }}"  name="sub_lob" id="sub_lob" placeholder="Enter Sub Lob">
                                @error('sub_lob') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="college_name" class="form-label mb-8 h6">College Name</label>
                                <input type="text" class="form-control py-11 @error('college_name') is-invalid @enderror"  value="{{ $user->college_name }}"  name="college_name" id="college_name" placeholder="Enter College Name">
                                @error('college_name') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="location" class="form-label mb-8 h6">Joining Location</label>
                                <select class="form-control py-11 @error('location') is-invalid @enderror" required name="location">
                                    <option value="">{{ __('Select Joining Location') }}</option>
                                    <option {{ $user->location == "Gurugram" ? 'selected' : '' }} value="Gurugram">Gurugram</option>
                                    <option {{ $user->location == "Bangalore" ? 'selected' : '' }} value="Bangalore">Bangalore</option>
                                    <option {{ $user->location == "Mumbai" ? 'selected' : '' }} value="Mumbai">Mumbai</option>
                                </select>
                                @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="qualification" class="form-label mb-8 h6">Qualification</label>
                                <input type="text" class="form-control py-11 @error('qualification') is-invalid @enderror"  value="{{ $user->qualification }}"  name="qualification" id="qualification" placeholder="Enter Qualification">
                                @error('qualification') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="specialization" class="form-label mb-8 h6">Specialization</label>
                                <input type="text" class="form-control py-11 @error('specialization') is-invalid @enderror"  value="{{ $user->specialization }}"  name="specialization" id="specialization" placeholder="Enter Specialization">
                                @error('specialization') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="college_location" class="form-label mb-8 h6">College Location</label>
                                <input type="text" class="form-control py-11 @error('college_location') is-invalid @enderror"  value="{{ $user->college_location }}"  name="college_location" id="college_location" placeholder="Enter College Location">
                                @error('college_location') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>

                            <div class="col-sm-6 col-xs-6">
                                <label for="college_tier" class="form-label mb-8 h6">College Tier</label>
                                <select class="form-control py-11 @error('college_tier') is-invalid @enderror" required name="college_tier">
                                    <option value="">{{ __('Select College Tier') }}</option>
                                    <option {{ $user->college_tier == "Tier 1" ? 'selected' : '' }} value="Tier 1">Tier 1</option>
                                    <option {{ $user->college_tier == "Tier 2" ? 'selected' : '' }} value="Tier 2">Tier 2</option>
                                    <option {{ $user->college_tier == "Tier 3" ? 'selected' : '' }} value="Tier 3">Tier 3</option>
                                </select>
                                @error('college_tier') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            

                            <div class="col-sm-6 col-xs-6">
                                <label for="offer_release_spoc" class="form-label mb-8 h6">Offer Release Spoc</label>
                                <input type="text" class="form-control py-11 @error('offer_release_spoc') is-invalid @enderror"  value="{{ $user->offer_release_spoc }}"  name="offer_release_spoc" id="offer_release_spoc" placeholder="Enter Offer Release Spoc">
                                @error('offer_release_spoc') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="trf" class="form-label mb-8 h6">TRF</label>
                                <input type="text" class="form-control py-11 @error('trf') is-invalid @enderror"  value="{{ $user->trf }}"  name="trf" id="trf" placeholder="Enter RTF">
                                @error('trf') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="joiner_status" class="form-label mb-8 h6">Joiner Status</label>
                                <select class="form-control py-11 @error('joiner_status') is-invalid @enderror" required name="joiner_status">
                                    <option value="">{{ __('Select Joiner Status') }}</option>
                                    <option {{ $user->joiner_status == "Yet to Join" ? 'selected' : '' }} value="Yet to Join">Yet to Join</option>
                                    <option {{ $user->joiner_status == "Joined" ? 'selected' : '' }} value="Joined">Joined</option>
                                </select>
                                @error('joiner_status') <div class="invalid-feedback">{{ $message }}</div> @enderror  
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
        
    </div>
</div>


   
@endsection