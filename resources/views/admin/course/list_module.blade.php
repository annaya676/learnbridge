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
            {{-- <button type="button" class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9">Back</button> --}}
            <a href="{{ route('course.module.create',$course->id) }}" class="btn btn-main rounded-pill py-9" >Create Module</a>
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

    <div class="card mt-24">
        <div class="card-header border-bottom border-gray-100 flex-align gap-8">
            <h5 class="mb-0">Module List</h5>        
        </div>
        
        <div class="card-body p-0 overflow-x-auto">
            <table id="moduleTable" class="table table-lg  table-bordered table-striped w-100">
                <thead>
                    <tr>
                        <th class="h6 text-gray-300" style="width: 300px;">{{ __('Module Name') }}</th>
                        <th class="h6 text-gray-300" style="width: 100px;">{{ __('Duration(min)') }}</th>
                        <th class="h6 text-gray-300" >{{ __('Description') }}</th>
                        <th class="h6 text-gray-300" style="width: 100px;">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                
            </table>
        </div>
    </div>

</div>




@section('scripts')

<script type="text/javascript">

   var table = $('#moduleTable').DataTable({
                ordering: false,
                processing: true,
                serverSide: true,
                searching: true,
                lengthChange: false,
                info: false,   // Bottom Left Text => Showing 1 to 10 of 12 entries

               ajax: "{{ route('course.module.datatables',$course->id) }}",
                columns: [
                { data: 'module_name', name: 'module_name', },
                { data: 'duration', name: 'duration', },
                { data: 'description', name: 'description', },
                { data: 'action', searchable: false, orderable: false  }
                ],
                language : {
                 processing: '<img src="{{asset('public/assets/images/logo/logo.png')}}">'
                },
                drawCallback: function () {
                $('.paging_full_numbers').addClass('card-footer flex-between flex-wrap');
                },
            });

        
    				
</script>

{{-- DATA TABLE --}}

@endsection


@endsection