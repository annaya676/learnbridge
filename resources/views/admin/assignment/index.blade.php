@extends('layouts.lms')
@section('content')
<div class="dashboard-body">

    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <!-- Breadcrumb Start -->
        <div class="breadcrumb mb-24">
        <ul class="flex-align gap-4">
        <li><a href="{{ route('dashboard') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
        <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
        <li><span class="text-main-600 fw-normal text-15">Assignment</span></li>
        </ul>
        </div>
<!-- Breadcrumb End -->

       
    </div>
   
    @include('includes.validation-error')


    <div class="card overflow-hidden">
        <div class="card-body p-0 pt-10">
            <table id="assignmentTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="h6 text-gray-300"  >{{ __('User Name') }}</th>
                        <th class="h6 text-gray-300" >{{ __('Course Name') }}</th>
                        <th class="h6 text-gray-300" >{{ __('Assignment') }}</th>
                        <th class="h6 text-gray-300" >{{ __('LOB') }}</th>
                        <th class="h6 text-gray-300" >{{ __('Select SME') }}</th>
                        <th class="h6 text-gray-300" >{{ __('Assigned') }}</th>
                        <th class="h6 text-gray-300"  style="width: 111px;" >{{ __('Status') }}</th>
                        <th class="h6 text-gray-300" style="width: 108px;">{{ __('Actions') }}</th>

                    </tr>
                </thead>
                
            </table>
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
         
               ajax: '{{ route('assignment.datatables') }}',
               columns: [
                { data: 'user_name', name: 'user_name' },
                { data: 'course_name', name: 'course_name' },
                { data: 'assignment_file', name: 'assignment_file' },
                { data: 'lob_id', name: 'lob_id' },
                { data: 'assign_sme', name: 'assign_sme' },
                { data: 'assignment_assign', name: 'assignment_assign' },
                { data: 'assignment_status',  name: 'assignment_status'  },
                { data: 'action', searchable: false, orderable: false }
                     ],
                language : {
                 processing: '<img src="{{asset('public/assets/images/logo/logo.png')}}">'
                },
                drawCallback: function () {
                $('.paging_full_numbers').addClass('card-footer flex-between flex-wrap');
                },


        });	


    // Handle the status change event
    $(document).on('change', '.sme-select', function() {
        var courseId = $(this).data('id'); // Get user ID
        var smeId = $(this).val();      // Get selected status value
        
        $.ajax({
            url: "{{ route('assignment.sme.update') }}",  // Route to handle AJAX update
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",  // Include CSRF token
                id: courseId,
                sme_id: smeId
            },
            success: function(response) {
                if (response.success) {
                    alert('Status updated successfully!');
                    table.ajax.reload(null, false);  // Reload DataTable
                } else {
                    alert('Error updating status');
                }
            },
            error: function() {
                alert('Error occurred while updating status');
            }
        });
    });
    
});

</script>

{{-- DATA TABLE --}}

@endsection
@endsection