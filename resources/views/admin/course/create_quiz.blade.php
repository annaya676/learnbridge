@extends('layouts.lms')
@section('content')


<div class="dashboard-body">
    <!-- Breadcrumb Start -->
    <div class="breadcrumb mb-24">
        <ul class="flex-align gap-4">
            <li><a href="{{ route('dashboard') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
            <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
            <li><span class="text-main-600 fw-normal text-15">Course</span></li>
        </ul>
    </div>
    <!-- Breadcrumb End -->
                 
                <!-- Create Course Step List Start -->
                <ul class="step-list mb-24">
                    <li class="step-list__item py-15 px-24 text-15 text-heading fw-medium flex-center gap-6">
                        <span class="icon text-xl d-flex"><i class="ph ph-circle"></i></span> 
                        <a href="{{ route('course.edit',$course->id) }}" class="text-heading">Course Details</a>
                        <span class="line position-relative"></span>
                    </li>
                    <li class="step-list__item py-15 px-24 text-15 text-heading fw-medium flex-center gap-6 active">
                        <span class="icon text-xl d-flex"><i class="ph ph-circle"></i></span> 
                        Quiz
                        <span class="line position-relative"></span>
                    </li>
                    <li class="step-list__item py-15 px-24 text-15 text-heading fw-medium flex-center gap-6">
                        <span class="icon text-xl d-flex"><i class="ph ph-circle"></i></span> 
                        <a href="{{ route('course.module',$course->id) }}" class="text-heading">Upload Module</a>
                        <span class="line position-relative"></span>
                    </li>
                    
                    
                </ul>
                <!-- Create Course Step List End -->
            

    <div class="card">
        <div class="card-header border-bottom border-gray-100 flex-align gap-8">
            <h5 class="mb-0">Create Quiz</h5>        
        </div>
        <div class="card-body">
            
            @include('includes.validation-error')

            <form id="form-create" action="{{ route('course.importquizcsv',$course->id)}}" method="post"  class="needs-validation" novalidate enctype="multipart/form-data">
                @csrf
                <div class="row gy-4">
                    <div class="col-sm-6 col-xs-6">
                        <label for="fname" class="form-label mb-8 h6">Quiz <span class="text-13 text-gray-400 fw-medium">(Required)</span> </label>
                        <input type="file" name="file" class="form-control py-11 @error('file') is-invalid @enderror" id="file" placeholder="Enter First Name">
                        @error('file') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                        <div id="emailHelp" class="form-text">Upload only csv.  <a  href="{{ asset('public/assets/lms_quiz_sample.csv') }}" download="quiz_sample.csv"  >Sample File</a> </div>
                    </div>
                    
                    <div class="col-sm-6 col-xs-6 ">
                        <div class="flex-align justify-content-end gap-8 mt-30">
                            <button type="submit" class="btn btn-main rounded-pill py-9">Save Changes</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="card mt-24">
        <div class="card-header border-bottom border-gray-100 flex-align gap-8">
            <h5 class="mb-0">Quiz Question List</h5>        
        </div>
       
        <div class="card-body p-0 overflow-x-auto">
            <table id="quizTable" class="table table-lg  table-bordered table-striped w-100">
                <thead>
                    <tr>
                        <th class="h6 text-gray-300">{{ __('Question') }}</th>
                        <th class="h6 text-gray-300">{{ __('Option A') }}</th>
                        <th class="h6 text-gray-300">{{ __('Option B') }}</th>
                        <th class="h6 text-gray-300">{{ __('Option C') }}</th>
                        <th class="h6 text-gray-300">{{ __('Option D') }}</th>
                        <th class="h6 text-gray-300">{{ __('Answer') }}</th>
                        <th class="h6 text-gray-300">{{ __('Actions') }}</th>
                    </tr>
                </thead>
               
            </table>
        </div>
    </div>

</div>



<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Quiz</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="editForm" method="POST">
            @csrf
            <input type="hidden" class="form-control" id="quiz_id" name="quiz_id">

            <div class="mb-3">
              <label for="question" class="col-form-label">Question</label>
              <textarea class="form-control" id="question" name="question"></textarea>
              <div class="invalid" id="question-error"></div> 
            </div>
              <div class="mb-3">
                <label for="option_a" class="col-form-label">Option A</label>
                <input type="text" class="form-control" id="option_a" name="option_a">
                <div class="invalid" id="option_a-error"></div> 
              </div>
              <div class="mb-3">
                <label for="option_b" class="col-form-label">Option B</label>
                <input type="text" class="form-control" id="option_b" name="option_b">
                <div class="invalid" id="option_b-error"></div> 
              </div>
              <div class="mb-3">
                <label for="option_c" class="col-form-label">Option C</label>
                <input type="text" class="form-control" id="option_c" name="option_c">
                <div class="invalid" id="option_c-error"></div> 
              </div>
              <div class="mb-3">
                <label for="option_d" class="col-form-label">Option D</label>
                <input type="text" class="form-control" id="option_d" name="option_d">
                <div class="invalid" id="option_d-error"></div> 
              </div>
              <div class="mb-3">
                <label for="correct_answer" class="col-form-label">Currect Answer</label>
                <input type="text" class="form-control" id="correct_answer" name="correct_answer" placeholder="A">
                <div class="invalid" id="correct_answer-error"></div> 
            </div>

              <div class="mt-18 text-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
              </div>

          </form>
        </div>
      
      </div>
    </div>
  </div>


@section('scripts')

<script type="text/javascript">
    // $(document).ready(function() {
        $('#editForm').submit(function(e) {
            e.preventDefault();

            var question = $('#question').val();
            var option_a = $('#option_a').val();
            var option_b = $('#option_b').val();
            var option_c = $('#option_c').val();
            var option_d = $('#option_d').val();
            var correct_answer = $('#correct_answer').val();
            var qiz_id = $('#qiz_id').val();

            $.ajax({
                type: 'POST',
                url: '{{ route('course.updatequiz') }}',
                // data: {
                //     _token: '{{ csrf_token() }}',
                //     qiz_id: qiz_id,
                //     question : question,
                //     option_a : option_a,
                //     option_b : option_b,
                //     option_c  : option_c,
                //     option_d : option_d,
                //     correct_answer : correct_answer,
                // },
                data: $('#editForm').serialize(),

                success: function(data) {
                    console.log(data);
                    if (data.status === 'success') {
                        $('#editModal').modal('hide');
                        location.reload();
                    } else {
                        $.each(data.errors, function(key, value) {
                            $('#' + key + '-error').text(value[0]);
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.log(xhr);
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key + '-error').text(value[0]);
                        });
                    }
                }
            });
        });
    // });

   function editQuiz(id) {
    $.ajax({
        type: 'GET',
        url: '{{ route('course.editquiz') }}',
        data: { id: id },
        success: function(data) {
            // console.log(data);
            $('.invalid').text('');
            $('#quiz_id').val(data.id);
            $('#question').val(data.question);
            $('#option_a').val(data.option_a);
            $('#option_b').val(data.option_b);
            $('#option_c').val(data.option_c);
            $('#option_d').val(data.option_d);
            $('#correct_answer').val(data.correct_answer);
            $('#editModal').modal('show');
        }
    });
    }
//     console.log( "ready!" );
// });
   var table = $('#quizTable').DataTable({
                ordering: false,
                processing: true,
                serverSide: true,
                searching: true,
                lengthChange: false,
                info: false,   // Bottom Left Text => Showing 1 to 10 of 12 entries

               ajax: "{{ route('course.quiz.datatables',$course->id) }}",
                columns: [
                { data: 'question', name: 'question',  },
                { data: 'option_a', name: 'option_a' },
                { data: 'option_b', name: 'option_b'  },
                { data: 'option_c', name: 'option_c', },
                { data: 'option_d', name: 'option_d', },
                { data: 'correct_answer', name: 'correct_answer', },
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