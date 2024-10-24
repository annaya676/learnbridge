@extends('layouts.user')
@section('content')

<style>
    #timer {
        font-size: 1.5rem;
        color: red;
    }
</style>    
<div class="dashboard-body">
    <!-- Breadcrumb Start -->
<div class="breadcrumb mb-24">
<ul class="flex-align gap-4">
<li><a href="#" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
<li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
<li><span class="text-main-600 fw-normal text-15">Quiz</span></li>
</ul>
</div>
<!-- Breadcrumb End -->

 <!-- Course Tab Start -->
 <div class="card">
    <div class="card-body">
        <div class="mb-20 flex-between flex-wrap gap-8">
            <h3 class="mb-0"> {{ $details->course->course_name }} - Quiz</h3>
         
        </div>
        <form method="POST" action="{{ route('quiz.answer', [$details->course->id, $question->id]) }}">
            @csrf
        <div class="row gy-20">
            

            <div class="container mt-5">
                <div id="quiz" class="mt-4">
                 
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $question->question }}</h5>

                            <div class="form-check">
                                    <input class="form-check-input" {{ $selectedAns=='A'?'checked':''}} type="radio" name="answer" value="A" >
                                    <label class="form-check-label" for="answer">{{ $question->option_a }}</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" {{ $selectedAns=='B'?'checked':''}} type="radio" name="answer" value="B" >
                                    <label class="form-check-label" for="answer">{{ $question->option_b }}</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" {{ $selectedAns=='C'?'checked':''}} type="radio" name="answer" value="C" >
                                    <label class="form-check-label" for="answer">{{ $question->option_c }}</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" {{ $selectedAns=='D'?'checked':''}} type="radio" name="answer" value="D" >
                                    <label class="form-check-label" for="answer">{{ $question->option_d }}</label>
                                </div>
                        </div>
                    </div>

                   

                </div>
                <div class="text-center mt-4">

                    @if ($questionindex >0)
                    <a href="{{ route('quiz.question',[$details->course->id, ($questionindex-1)]) }}" class="btn btn-secondary rounded-pill py-9">
                        Previous
                    </a>
                    @else
                    <button id="prevBtn" class="btn btn-secondary rounded-pill py-9" disabled>Previous</button>

                    @endif
                        
                    @if ($questionCount == ($questionindex+1))
                    <input type="hidden" value="0" name="questionindex">

                    <button type="submit" class="btn btn-primary rounded-pill py-9">Submit</button>
                    @else
                    <input type="hidden" value="{{ $questionindex+1 }}" name="questionindex">

                    <button type="submit" class="btn btn-primary rounded-pill py-9">Next</button>

                    @endif

               
                </div>
            </div>
  
        </div>

    



 
</form>



    </div>
</div>
<!-- Course Tab End -->

</div>
   

@endsection