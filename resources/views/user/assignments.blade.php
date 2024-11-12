@extends('layouts.user')
@section('content')

        
<div class="dashboard-body">
    <!-- Breadcrumb Start -->
<div class="breadcrumb mb-24">
<ul class="flex-align gap-4">
<li><a href="{{ route('user.home') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
<li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
<li><span class="text-main-600 fw-normal text-15">Upload Assignment</span></li>
</ul>
</div>
<!-- Breadcrumb End -->

 <!-- Course Tab Start -->
 <div class="card">
    <div class="card-body">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

        <div class="flex-align gap-8 mt-1">
        @if ($details->assignment_status==2)
        <p class="text-13 py-2 px-8 bg-warning-50 text-warning-600 d-inline-flex align-items-center gap-8 rounded-pill">
            In Review 
        </p>
        @elseif ($details->assignment_status==1)
        <p class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill">
            Complete
        </p>
        @elseif ($details->assignment_status==3)
        <p class="text-13 py-2 px-8 bg-danger-50 text-danger-600 d-inline-flex align-items-center gap-8 rounded-pill">
            Rework 
        </p>
        @else
     
        @endif 
        
        </div>


    @if ($details->assignment_status==3 || $details->assignment_status==0)    
    <form action="{{ route('user.assignments.upload',$details->course->id)}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf
    
        <div class="row gy-20">
         
            <div class="col-xxl-9 col-md-8 col-sm-7">
                <div class="row g-20">
                    <div class="col-sm-12">
                        <label for="courseTitle" class="h5 mb-8 fw-semibold font-heading">Assignment <span class="text-13 text-gray-400 fw-medium">(Required)</span> </label>
                        <div class="position-relative">
                            <input type="file" name="file" class=" form-control py-11 pe-76 @error('file') is-invalid @enderror" >
                            @error('file') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                        </div>
                    </div>
                 
                </div>
            </div>
            <div class="flex-align justify-content-end gap-8">
                <button type="reset" class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9">Cancel</button>
                <button type="submit" class="btn btn-main rounded-pill py-9">Upload</button>
             </div>
        </div>

    </form>
   
    @endif 

@if($details->assignment_sme_file)
    <h5>Download SME Feedback</h5>
    <div class="flex-align gap-8 mt-1">
        <a href="{{   asset('public/uploads/assignment/'.$details->assignment_sme_file) }}" class="py-9 w-100 "><i class="ph ph-download"></i> Download </a>
    </div>
@endif

@if ( $details->assignment_remark !='')
    <h5>Remark</h5>
    <div class="flex-align gap-8 mt-1">
        <p>{{ $details->assignment_remark }}</p>
    </div>

@endif



    </div>
</div>
<!-- Course Tab End -->

</div>
   
@endsection