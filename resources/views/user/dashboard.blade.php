@extends('layouts.user')
@section('content')

@section('styles')
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
@endsection
  
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

        <div class="row g-20">
            @php
                $privous=0;
                $i=0;

            @endphp
            @foreach ($categoryData as $key=>$myCategory)
            @if ($myCategory['course_count']>0)
    
            @php

            if($i==0){
                $isActive = 1;
                $privous  = $course_completed_status[$myCategory['category_id']];
            }else if($privous==1){
                $isActive =1;
                $privous =$course_completed_status[$myCategory['category_id']];
            }else{
                $isActive =$course_completed_status[$myCategory['category_id']];
                $privous =$course_completed_status[$myCategory['category_id']];
            }
            $i++;
            @endphp
          
    
            <div class="col-xxl-3 col-lg-4 col-sm-6">
                <div class="card {{ $isActive==0?'deactive-card':'active-card' }} border border-gray-100">
                    <div class="card-body p-8">
                        <a href="{{ $isActive==1?route('user.courses',$myCategory['category_id']):'javascript:void(0)' }}" class="bg-main-100 rounded-8 overflow-hidden text-center mb-8 h-164 flex-center">
                            <img src="{{    asset('public/uploads/category/'.$myCategory['category_image']) }}" alt="Course Image">
                        </a>
                        <div class="p-8">
                            <h5 class="mb-0 text-center"><a href="{{ $isActive==1?route('user.courses',$myCategory['category_id']):'javascript:void(0)' }}" class="hover-text-main-600">{{ $myCategory['category_subset'] }} ({{ $myCategory['course_count'] }})</a></h5>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach

        </div>
     
</div>
   
@endsection