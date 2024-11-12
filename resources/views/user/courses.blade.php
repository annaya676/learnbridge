@extends('layouts.user')
@section('content')

        
<div class="dashboard-body">
    <!-- Breadcrumb Start -->
<div class="breadcrumb mb-24">
<ul class="flex-align gap-4">
<li><a href="{{ route('user.home') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
<li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
<li><span class="text-main-600 fw-normal text-15">Courses</span></li>
<li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
<li><span class="text-main-600 fw-normal text-15">{{ $category->subset }}</span></li>


</ul>
</div>
<!-- Breadcrumb End -->

        <div class="row g-20">
            @foreach ($myCourses as $myCourse)
            @if ($myCourse->course)
            @php
                $total_module =  count($myCourse->course->module);
                $is_read_docs = ($myCourse->is_read_docs!='')?explode(",",$myCourse->is_read_docs):array();
                $is_read_video = ($myCourse->is_read_video!='')?explode(",",$myCourse->is_read_video):array();
                $totalWatch = array_unique(array_merge($is_read_docs,$is_read_video));
                $totalWatchCount=  count($totalWatch);
                if ($myCourse->course->isquiz==1){
                    $total_module=$total_module+1;
                    if($myCourse->quiz_status==1){
                        $totalWatchCount=$totalWatchCount+1;
                    } 
                }
                if ($myCourse->course->assignment !=''){
                    $total_module=$total_module+1;
                    if($myCourse->assignment_status==1){
                        $totalWatchCount=$totalWatchCount+1;
                    }
                } 
                if($total_module >0){
                    $progressbar=($totalWatchCount*100)/ $total_module;
                }else{
                    $progressbar=0;
                }
                
                if($myCourse->is_complete==1){
                    $progressbar=100;
                }
            @endphp
            <div class="col-xxl-3 col-lg-4 col-sm-6">
                <div class="card border border-gray-100">
                    <div class="card-body p-8">
                        <a href="{{ route('user.course',$myCourse->course->id) }}" class="bg-main-100 rounded-8 overflow-hidden text-center mb-8 h-164 flex-center">
                            <img src="{{    asset('public/uploads/thumb/'.$myCourse->course->image) }}" alt="Course Image">
                        </a>
                        <div class="p-8">
                            <h5 class="mb-0"><a href="{{ route('user.course',$myCourse->course->id) }}" class="hover-text-main-600">{{ $myCourse->course->course_name }}</a></h5>
                             <div class="flex-align gap-8 mt-12">
                                <span class="text-main-600 flex-shrink-0 text-13 fw-medium">{{ round($progressbar) }}%</span>
                                <div class="progress w-100  bg-main-100 rounded-pill h-8" role="progressbar" aria-label="Basic example" aria-valuenow="{{ $progressbar }}" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-main-600 rounded-pill" style="width: {{ $progressbar }}%"></div>
                                </div>
                            </div>
                            {{-- <a href="{{ route('user.course',$myCourse->course->id) }}" class="btn btn-outline-main rounded-pill py-9 w-100 mt-24"> 
                                @if($myCourse->is_complete==1)
                                {{'complete'}}
                                @elseif ($progressbar > 0)
                                {{ 'Continue' }}
                                @else
                                {{ 'Start' }}
                                @endif
                            </a> --}}
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach

        </div>
     

</div>
   
@endsection