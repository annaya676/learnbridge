@extends('layouts.lms')
@section('content')


<div class="dashboard-body">
    <!-- Breadcrumb Start -->
    <div class="breadcrumb mb-24">
        <ul class="flex-align gap-4">
            <li><a href="{{ route('dashboard') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
            <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
            <li><span class="text-main-600 fw-normal text-15">Assignment</span></li>
        </ul>
    </div>
    <!-- Breadcrumb End -->
                 
    

    <div class="tab-content" id="pills-tabContent">
        <!-- My Details Tab start -->
        <div class="tab-pane fade show active" id="pills-details" role="tabpanel" aria-labelledby="pills-details-tab" tabindex="0">
            <div class="card mt-24">
                <div class="card-header border-bottom">
                    <h4 class="mb-4">Edit Assignment</h4>
                </div>
                <div class="card-body">
                    
                    @include('includes.validation-error')


                    <form id="form-create" action="{{ route('assignment.update', $data->id)}}" method="post"  class="needs-validation"  enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row gy-4">
                            

                            <div class="col-8">
                                <label for="lob" class="form-label mb-8 h6">Status</label>
                                <select class="form-control py-11 @error('status') is-invalid @enderror" required name="status">
                                    
                                    <option value="">{{ __('Select status') }}</option>
                                    <option  value="2" {{ $data->assignment_status==2 ?'selected':'' }} >In Review</option>
                                    <option  value="3" {{ $data->assignment_status==3 ?'selected':'' }} >Rework</option>
                                    <option  value="1" {{ $data->assignment_status==1 ?'selected':'' }} >Complete</option>
                                </select>

                                </select>
                                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>

                            <div class="col-8">
                                <label for="smefile" class="form-label mb-8 h6">Feed Back File </label>
                                <input type="file" class="form-control py-11 @error('smefile') is-invalid @enderror" name="smefile" id="smefile">
                                @error('smefile') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                                <div id="emailHelp" class="form-text">Upload only zip, excel, word and pdf.</div>
                                @if($data->assignment_sme_file)
                                    <div class="flex-align gap-8 mt-1">
                                        <a href="{{   asset('public/uploads/assignment/'.$data->assignment_sme_file) }}" class="py-9 w-100 "><i class="ph ph-download"></i> Preview </a>
                                    </div>
                                @endif
                            </div>


                            <div class="col-8">
                                <label for="email" class="form-label mb-8 h6">Remark</label>
                                <textarea class="form-control py-11 @error('remark') is-invalid @enderror" required name="remark"  id="remark" placeholder="Enter Remark">{{ $data->assignment_remark }}</textarea>
                                @error('remark') <div class="invalid-feedback">{{ $message }}</div> @enderror  

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