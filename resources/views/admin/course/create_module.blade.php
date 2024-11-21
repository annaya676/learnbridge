@extends('layouts.lms')
@section('content')

<div class="dashboard-body">
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
    <!-- Breadcrumb Start -->
    <div class="breadcrumb mb-24">
        <ul class="flex-align gap-4">
            <li><a href="{{ route('dashboard') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
            <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
            <li><span class="text-main-600 fw-normal text-15">Course</span></li>
        </ul>
    </div>
    <div class="flex-align justify-content-end gap-8">
        <a href="{{ route('course.module',$course->id) }}" class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9" >Back</a>
    </div>
    <!-- Breadcrumb End -->
    </div>          
                <!-- Create Course Step List Start -->
                <ul class="step-list mb-24">
                    <li class="step-list__item py-15 px-24 text-15 text-heading fw-medium flex-center gap-6">
                        <span class="icon text-xl d-flex"><i class="ph ph-circle"></i></span> 
                        <a href="{{ route('course.edit',$course->id) }}" class="text-heading">Course Details</a>
                        <span class="line position-relative"></span>
                    </li>
                    <li class="step-list__item py-15 px-24 text-15 text-heading fw-medium flex-center gap-6">
                        <span class="icon text-xl d-flex"><i class="ph ph-circle"></i></span> 
                        <a href="{{ route('course.quiz',$course->id) }}" class="text-heading"> Quiz</a>
                        <span class="line position-relative"></span>
                    </li>
                    <li class="step-list__item py-15 px-24 text-15 text-heading fw-medium flex-center gap-6 active">
                        <span class="icon text-xl d-flex"><i class="ph ph-circle"></i></span>
                        Upload Module
                        <span class="line position-relative"></span>
                    </li>
                    
                    
                </ul>
                <!-- Create Course Step List End -->
            

                <div class="card">
                    <div class="card-header border-bottom border-gray-100 flex-align gap-8">
                        <h5 class="mb-0">Create Module</h5>        
                    </div>
                    <div class="card-body">
                       
                        @include('includes.validation-error')

            
                        <form id="form-create" action="{{ route('course.modulestore',$course->id)}}" method="post"  class="needs-validation" novalidate enctype="multipart/form-data">
                            @csrf
                            <div class="row gy-4">
                                <div class="col-sm-6 col-xs-6">
                                    <label for="module_name" class="form-label mb-8 h6">Module Name <span class="text-13 text-gray-400 fw-medium">(Required)</span> </label>
                                    <input type="text" name="module_name" value="{{ old('module_name', '') }}"  class="form-control py-11 @error('module_name') is-invalid @enderror" id="file" placeholder="Enter Module Name">
                                    @error('module_name') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    <label for="duration" class="form-label mb-8 h6">Duration <span class="text-13 text-gray-400 fw-medium">(Required)</span> </label>
                                    <input type="number" name="duration" value="{{ old('duration', '') }}"    oninput="this.value = this.value.replace(/[^0-9.]/g, '')" class="form-control py-11 @error('duration') is-invalid @enderror" id="duration" placeholder="Enter Duration">
                                    @error('duration') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                                </div>
                                <div class="col-sm-12 col-xs-12">
                                    <label for="description" class="form-label mb-8 h6">Description <span class="text-13 text-gray-400 fw-medium">(Required)</span> </label>
                                    <textarea name="description"  class="form-control py-11 @error('description') is-invalid @enderror" id="description" placeholder="Enter Description Name">{{ old('description', '') }}</textarea>
                                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    <label for="video" class="form-label mb-8 h6">Video</label>
                                    <input type="file" name="video" class="form-control py-11 @error('video') is-invalid @enderror" id="video" >
                                    @error('video') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                                    <div id="emailHelp" class="form-text">Upload only mp4.</div>
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    <label for="pdf" class="form-label mb-8 h6">Pdf  </label>
                                    <input type="file" name="pdf" class="form-control py-11 @error('pdf') is-invalid @enderror" id="pdf" >
                                    @error('pdf') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                                    <div id="pdfHelp" class="form-text">Upload only pdf.</div>
                                </div>
                                
                                <div class="col-sm-12 col-xs-12 ">
                                    <div class="flex-align justify-content-end gap-8">
                                        <button type="submit" class="btn btn-main rounded-pill py-9">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            
          

</div>




@section('scripts')

{{-- DATA TABLE --}}

@endsection


@endsection