@extends('layouts.user')
@section('content')

<style>
    #timer {
        font-size: 1.5rem;
        color: red;
    }
</style>    
<style>
    .form-check-input:disabled {
  
    opacity: 1;
}
.form-check-input:disabled~.form-check-label, .form-check-input[disabled]~.form-check-label {
    opacity: 1;
}
</style>

<div class="dashboard-body">
    <!-- Breadcrumb Start -->
<div class="breadcrumb mb-24">
<ul class="flex-align gap-4">
<li><a href="{{ route('user.home') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
<li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
<li><span class="text-main-600 fw-normal text-15">Quiz</span></li>
</ul>
</div>
<!-- Breadcrumb End -->

 <!-- Course Tab Start -->
 <div class="card">
    <div class="card-body">
        <div class="mb-20 flex-between flex-wrap gap-8">
            <h3 class="mb-0"> {{ $coursedetails->course->course_name }} - Quiz Result</h3>
         
        </div>
       
        <div class="row gy-20">
            

            <div class="container mt-5">
                 
                    <div class="card">
                        <div class="card-body">

                            <p class="pb-10">Your score: {{ $coursedetails->quiz_score }} /  {{ $questions->count() }} </p>
                            
                            @if ($coursedetails->quiz_status==1)
                            Your Result: <p class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                Pass
                            </p>
                            @else
                            Your Result: <p class="text-13 py-2 px-8 bg-danger-50 text-danger-600 d-inline-flex align-items-center gap-8 rounded-pill">
                              Fail
                            </p>
                            @endif

                            @if ($coursedetails->quiz_status != 1)
                            <p class="pt-10"><a class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white" href="{{ route('quiz.retake', $coursedetails->course->id) }}">Retake the quiz</a></p>  
                            @endif
<hr/>

@if ($coursedetails->quiz_status==1)

@foreach ($userAnswers as $ans)
    
<h5 class="card-title">{{ $ans->questions->question }}</h5>
<div class="form-check">
        <input class="form-check-input" {{ $ans->answer=='A'?'checked':''}} type="radio" name="answer{{ $ans->id }}" @disabled(true) value="A" >
        <label class="form-check-label  {{ $ans->answer=='A' && $ans->answer!=$ans->questions->correct_answer?'text-danger':''}}" for="answer">{{ $ans->questions->option_a }} 
        @if ($ans->questions->correct_answer =='A')<i class="ph ph-check-fat" style="color: green; font-size: large;"></i> @endif
         </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" {{ $ans->answer=='B'?'checked':''}} type="radio" name="answer{{ $ans->id }}" @disabled(true) value="B" >
        <label class="form-check-label {{ $ans->answer=='B' && $ans->answer!=$ans->questions->correct_answer?'text-danger':''}}" for="answer">{{ $ans->questions->option_b }}
            @if ($ans->questions->correct_answer =='B')<i class="ph ph-check-fat" style="color: green; font-size: large;"></i> @endif
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" {{ $ans->answer=='C'?'checked':''}} type="radio" name="answer{{ $ans->id }}" @disabled(true) value="C" >
        <label class="form-check-label {{ $ans->answer=='C' && $ans->answer!=$ans->questions->correct_answer?'text-danger':''}}" for="answer">{{ $ans->questions->option_c }}
            @if ($ans->questions->correct_answer =='C')<i class="ph ph-check-fat" style="color: green; font-size: large;"></i> @endif
         </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" {{ $ans->answer=='D'?'checked':''}} type="radio" name="answer{{ $ans->id }}" @disabled(true) value="D" >
        <label class="form-check-label {{ $ans->answer=='D' && $ans->answer!=$ans->questions->correct_answer?'text-danger':''}}" for="answer">{{ $ans->questions->option_d }}
            @if ($ans->questions->correct_answer =='D')<i class="ph ph-check-fat" style="color: green; font-size: large;"></i> @endif
        </label>
    </div>
<p class="pb-10  text-success">Currect Answer: 
    @if ($ans->questions->correct_answer =='A')  
        <strong>{{ $ans->questions->option_a }}</strong>   
    @elseif ($ans->questions->correct_answer =='B')  
        <strong>{{ $ans->questions->option_b }}</strong>
    @elseif ($ans->questions->correct_answer =='C') 
        <strong>{{ $ans->questions->option_c  }}</strong>
    @else       
        <strong>{{ $ans->questions->option_d }}</strong>
    @endif
</p>
@endforeach
           

@endif







                        </div>
                    </div>

                   

               
            </div>
  
        </div>

 


    </div>
</div>
<!-- Course Tab End -->

</div>
   

@endsection