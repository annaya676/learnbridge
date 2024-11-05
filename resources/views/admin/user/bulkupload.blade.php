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
                 
           

    <div class="card">
        <div class="card-header border-bottom border-gray-100 flex-align gap-8">
            <h5 class="mb-0">Bulk Upload User </h5>        
        </div>
        <div class="card-body">
            @include('includes.validation-error')


            <form id="form-create" action="{{ route('user.importusercsv')}}" method="post"  class="needs-validation" novalidate enctype="multipart/form-data">
                @csrf
                <div class="row gy-4">
                    <div class="col-sm-6 col-xs-6">
                        <label for="fname" class="form-label mb-8 h6">User CSV <span class="text-13 text-gray-400 fw-medium">(Required)</span> </label>
                        <input type="file" name="file"  accept=".csv" class="form-control py-11 @error('file') is-invalid @enderror" id="file" placeholder="Enter First Name">
                        @error('file') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                        <div id="emailHelp" class="form-text">Upload only csv.  <a  href="{{ asset('public/assets/lms_user_sample.csv') }}" download="user_sample.csv"  >Sample File</a> </div>
                    </div>
                    
                    <div class="col-sm-6 col-xs-6 ">
                        <div class="flex-align justify-content-end gap-8 mt-30">
                            <button type="submit" class="btn btn-main rounded-pill py-9">Save Changes</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    

</div>




@endsection