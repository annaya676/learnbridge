@extends('layouts.user')
@section('content')
<style>
.active-card {
box-shadow: 0px 4px 8px rgba(0, 128, 0, 0.3); 
}
.deactive-card {
  opacity: 0.6; 
}
.card:hover {
  transform: scale(1.03); 
  transition: transform 0.3s ease; 
}
</style>
        
<div class="dashboard-body">
    <!-- Breadcrumb Start -->
<div class="breadcrumb mb-24">
<ul class="flex-align gap-4">
<li><a href="{{ route('user.home') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
<li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
<li><span class="text-main-600 fw-normal text-15">Categories</span></li>
</ul>
</div>
<!-- Breadcrumb End -->

 <!-- Course Tab Start -->
 {{-- <div class="card">
    <div class="card-body">
        --}}
        <div class="row g-20">
            @php
                $privous=0;
            @endphp
            @foreach ($myCategoryCourses as $key=>$myCategory)
            @php
            if($key==0){
                $isActive = 1;
                $privous  = $course_completed_status[$myCategory->id];
            }else if($privous==1){
                $isActive =1;
                $privous =$course_completed_status[$myCategory->id];
            }else{
                $isActive =$course_completed_status[$myCategory->id];
                $privous =$course_completed_status[$myCategory->id];
            }
            @endphp
            <div class="col-xxl-3 col-lg-4 col-sm-6">
                <div class="card {{ $isActive==0?'deactive-card':'active-card' }} border border-gray-100">
                    <div class="card-body p-8">
                        <a href="{{ $isActive==1?route('user.courses',$myCategory->id):'javascript:void(0)' }}" class="bg-main-100 rounded-8 overflow-hidden text-center mb-8 h-164 flex-center">
                            <img src="{{  asset('uploads/category/'.$myCategory->image) }}" alt="Course Image">
                        </a>
                        <div class="p-8">
                            <h5 class="mb-0 text-center"><a href="{{ $isActive==1?route('user.courses',$myCategory->id):'javascript:void(0)' }}" class="hover-text-main-600">{{ $myCategory->subset }}</a></h5>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
     
    {{-- </div>
</div> --}}
<!-- Course Tab End -->

</div>
   
@endsection