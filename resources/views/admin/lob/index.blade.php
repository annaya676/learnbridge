@extends('layouts.lms')
@section('content')
<div class="dashboard-body">

    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <!-- Breadcrumb Start -->
        <div class="breadcrumb mb-24">
        <ul class="flex-align gap-4">
        <li><a href="{{ route('dashboard') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
        <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
        <li><span class="text-main-600 fw-normal text-15">Line of Busines</span></li>
        </ul>
        </div>
<!-- Breadcrumb End -->

        <!-- Breadcrumb Right Start -->
        <div class="flex-align gap-8 flex-wrap">
            
            <div class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
                <span class="text-lg"><i class="ph ph-layout"></i></span>
                <select class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4 text-center" id="exportOptions">
                    <option value="" selected disabled>Export</option>
                    <option value="csv">CSV</option>
                    <option value="json">JSON</option>
                </select>
            </div>
        </div>
        <!-- Breadcrumb Right End -->

    </div>
   
    @include('includes.validation-error')


    <div class="card overflow-hidden">
        <div class="card-body p-0 pt-10">
            <table id="assignmentTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="h6 text-gray-300"  >{{ __('Name') }}</th>
                        <th class="h6 text-gray-300" width="450">{{ __('Description') }}</th>
                        <th class="h6 text-gray-300" >{{ __('Status') }}</th>
                        <th class="h6 text-gray-300">{{ __('Actions') }}</th>

                    </tr>
                </thead>
                
            </table>
        </div>
      
    </div>

    
</div>



@section('scripts')


<script type="text/javascript">
   
   var table = $('#assignmentTable').DataTable({
            ordering: false,
            processing: true,
            serverSide: true,
            searching: true,
            lengthChange: false,
            info: false,   // Bottom Left Text => Showing 1 to 10 of 12 entries
            paging: true,

               ajax: '{{ route('lob.datatables') }}',
               columns: [
                        { data: 'name', name: 'name' },
                        { data: 'description', name: 'description' },
                        { data: 'status',  name: 'status'  },
            			{ data: 'action', searchable: false, orderable: false }
                     ],
                language : {
                 processing: '<img src="{{asset('assets/images/logo/logo.png')}}">'
                },
                drawCallback: function () {
                $('.paging_full_numbers').addClass('card-footer flex-between flex-wrap');
                },


            });	
				
</script>

{{-- DATA TABLE --}}

@endsection
@endsection