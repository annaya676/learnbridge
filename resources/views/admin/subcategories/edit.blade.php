@extends('layouts.lms')
@section('content')


<div class="dashboard-body">
    <!-- Breadcrumb Start -->
    <div class="breadcrumb mb-24">
        <ul class="flex-align gap-4">
            <li><a href="{{ route('dashboard') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
            <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
            <li><span class="text-main-600 fw-normal text-15">Line of Busines</span></li>
        </ul>
    </div>
    <!-- Breadcrumb End -->
                 
    

    <div class="tab-content" id="pills-tabContent">
        <!-- My Details Tab start -->
        <div class="tab-pane fade show active" id="pills-details" role="tabpanel" aria-labelledby="pills-details-tab" tabindex="0">
            <div class="card mt-24">
                <div class="card-header border-bottom">
                    <h4 class="mb-4">Edit sub-categories</h4>
                </div>
                <div class="card-body">
                    
                    
                    @include('includes.validation-error')


                    <form id="form-create" action="{{ route('sub-categories.update', $subcategory->id)}}" method="post"  class="needs-validation" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row gy-4">
                            <div class="col-8">
                                <label for="category_id" class="form-label mb-8 h6">Category <span class="text-13 text-gray-400 fw-medium">(Required)</span> </label>
                                <select class="form-control select2 form-select py-11 @error('category_id') is-invalid @enderror" required name="category_id" data-placeholder="Choose category">
                                    
                                    <option value="">{{ __('Select category') }}</option>
                                    @foreach($category as $cat)
                                      <option  value="{{ $cat->id }}" {{  $cat->id==$subcategory->category_id?'selected':'' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>

                            <div class="col-8">
                                <label for="fname" class="form-label mb-8 h6">Name</label>
                                <input type="text" value="{{ $subcategory->name }}" class="form-control py-11 @error('name') is-invalid @enderror"   name="name" id="fname" placeholder="Enter Name">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            
                            <!-- <div class="col-8">
                                <label for="image" class="form-label mb-8 h6">Image </label>
                                <input type="file" class="form-control py-11 @error('image') is-invalid @enderror" name="image" id="image">
                                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                             
                            </div> -->

             
                           
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