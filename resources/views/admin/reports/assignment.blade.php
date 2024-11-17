@extends('layouts.lms')
@section('content')
<div class="dashboard-body">

    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <!-- Breadcrumb Start -->
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li><a href="{{ route('dashboard') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
                <li><span class="text-main-600 fw-normal text-15">Assignment Report</span></li>
            </ul>
        </div>
<!-- Breadcrumb End -->

        <!-- Breadcrumb Right Start -->
        <div class="flex-align gap-8 flex-wrap">
            <div class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
                <span class="text-lg"><i class="ph ph-layout"></i></span>
                <button type="button" class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4 text-center" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Export CSV
                </button>
            </div>
        </div>
        <!-- Breadcrumb Right End -->
       
          
        
    </div>
   
    @include('includes.validation-error')


    <div class="card overflow-hidden">
        <div class="card-body p-0 pt-10 overflow-x-auto">
            <table id="assignmentTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="h6 text-gray-300"  >{{ __('User Name') }}</th>
                        <th class="h6 text-gray-300" >{{ __('Course Name') }}</th>
                        <th class="h6 text-gray-300" >{{ __('LOB') }}</th>
                        <th class="h6 text-gray-300" >{{ __('Assigned') }}</th>
                        <th class="h6 text-gray-300" >{{ __('Date') }}</th>
                        {{-- <th class="h6 text-gray-300"  style="width: 111px;" >{{ __('Status') }}</th> --}}

                    </tr>
                </thead>
                
            </table>
        </div>
      
    </div>

    
</div>

   <!-- Modal Add Event -->
   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog modal-dialog-centered">
        <div class="modal-content radius-16 bg-base">
            <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Assignment Progress Report</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-24">
                <form method="POST" id="filter-form" action="{{ route('reports.assignment.export') }}">
                    @csrf
                    <div class="row">   
                        <div class="col mb-20">
                            <label for="startDate" class="form-label fw-semibold text-primary-light text-sm mb-8">Start Date</label>
                            <div class=" position-relative">
                                <input class="form-control radius-8 bg-base" max="{{ date('Y-m-d') }}" name="start_date" id="startDate" type="date">
                                <span class="position-absolute end-0 top-50 translate-middle-y me-12 line-height-1"></span>
                            </div>
                        </div>
                        <div class="col mb-20">
                            <label for="endDate" class="form-label fw-semibold text-primary-light text-sm mb-8">End Date </label>
                            <div class=" position-relative">
                                <input class="form-control radius-8 bg-base" max="{{ date('Y-m-d') }}" name="end_date" id="endDate" type="date">
                                <span class="position-absolute end-0 top-50 translate-middle-y me-12 line-height-1"></span>
                            </div>
                        </div>
                      
                     
                        <div class="d-flex align-items-center justify-content-center gap-8 mt-24">
                            <button type="reset" class="btn reset-filter bg-danger-600 hover-bg-danger-800 border-danger-600 hover-border-danger-800 text-md px-24 py-12 radius-8"> 
                                <i class="ph ph-arrow-clockwise"></i>
                            </button>
                            <button type="submit" class="btn bg-main-600 hover-bg-main-800 border-main-600 hover-border-main-800 text-md px-24 py-12 radius-8"> 
                                <i class="ph ph-download"></i>
                            </button>
                            <button type="button" class="btn filter bg-main-600 hover-bg-main-800 border-main-600 hover-border-main-800 text-md px-24 py-12 radius-8"> 
                                <i class="ph ph-funnel"></i>
                            </button>
                       
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    
@section('scripts')

<script type="text/javascript">

$(document).ready(function() {
 
    var table = $('#assignmentTable').DataTable({
            ordering: false,
            processing: true,
            serverSide: true,
            searching: true,
            lengthChange: false,
            info: false,   // Bottom Left Text => Showing 1 to 10 of 12 entries
            paging: true,
            //    ajax: '{{ route('reports.assignment.datatables') }}',
               ajax: {
                        url: '{{ route('reports.assignment.datatables') }}',
                        data: function (d) {
                            d.start_date = $('#startDate').val();
                            d.end_date = $('#endDate').val();
                        }
                    },
               columns: [
                        { data: 'user_name', name: 'user_name' },
                        { data: 'course_name', name: 'course_name' },
                        { data: 'lob_id', name: 'lob_id' },
                        { data: 'assignment_assign', name: 'assignment_assign' },
                        { data: 'assignment_upload_date',  name: 'assignment_upload_date'  },
                        // { data: 'assignment_status',  name: 'assignment_status'  },
                     ],
                language : {
                    processing: '<img src="{{asset('public/assets/images/logo/logo.png')}}">'
                },
                drawCallback: function () {
                $('.paging_full_numbers').addClass('card-footer flex-between flex-wrap');
                },
        });	

        $('.filter').on('click', function (e) {
            e.preventDefault();
            table.ajax.reload(); // Reload data with filters
        });
 
        $('.reset-filter').on('click', function (e) {
            e.preventDefault();
            $("#filter-form").trigger("reset");

            table.ajax.reload(); // Reload data with filters
        });
 

});  



$('#filter-form').on('submit', function (e) {
    e.preventDefault();
    document.getElementById("filter-form").submit();

    table.ajax.reload(); // Reload data with filters
});

</script>

{{-- DATA TABLE --}}

@endsection
@endsection