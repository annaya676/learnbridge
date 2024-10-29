@extends('layouts.lms')
@section('content')

 
<div class="dashboard-body">
    <div class="row gy-4">
        <div class="col-lg-9">
            {{-- {{ Auth::guard('admin')->user() }}        --}}

            <!-- Widgets Start -->
            <div class="row gy-4">
                <div class="col-xxl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('reports.course.completion') }}">
                            {{-- <h4 class="mb-2">{{ $courseCompletion }}+</h4> --}}
                            <span class="text-gray-600">Course Completion & Inprogress report</span>
                            </a>
                            <div class="flex-between gap-8 mt-16">
                                <span class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-main-600 text-white text-2xl"><i class="ph-fill ph-book-open"></i></span>
                                <div id="complete-course" class="remove-tooltip-title rounded-tooltip-value"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('reports.assignment') }}">
                            {{-- <h4 class="mb-2">{{ $assignment }}+</h4> --}}
                            <span class="text-gray-600">Assignment Progress Report</span>
                            </a>
                            <div class="flex-between gap-8 mt-16">
                                <span class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-main-two-600 text-white text-2xl"><i class="ph-fill ph-certificate"></i></span>
                                <div id="earned-certificate" class="remove-tooltip-title rounded-tooltip-value"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('reports.user.details') }}">
                            {{-- <h4 class="mb-2">{{ $userDetails }}+</h4> --}}
                            <span class="text-gray-600">User Report</span>
                            </a>
                            <div class="flex-between gap-8 mt-16">
                                <span class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-purple-600 text-white text-2xl"> <i class="ph-fill ph-graduation-cap"></i></span>
                                <div id="course-progress" class="remove-tooltip-title rounded-tooltip-value"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('reports.course.catalogue') }}">
                            {{-- <h4 class="mb-2">{{ $courseCatalogue }}+</h4> --}}
                            <span class="text-gray-600">Course Catalogue Report</span>
                            </a>
                            <div class="flex-between gap-8 mt-16">
                                <span class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-warning-600 text-white text-2xl"><i class="ph-fill ph-users-three"></i></span>
                                <div id="community-support" class="remove-tooltip-title rounded-tooltip-value"></div>
                            </div>
                       
                        </div>
                    </div>
                </div>
            </div>
            <!-- Widgets End -->

         
        </div>

        <div class="col-lg-3">
            <!-- Calendar Start -->
            <div class="card">
                <div class="card-body">
                    <div class="calendar">
                        <div class="calendar__header">
                            <button type="button" class="calendar__arrow left"><i class="ph ph-caret-left"></i></button>
                            <p class="display h6 mb-0">""</p>
                            <button type="button" class="calendar__arrow right"><i class="ph ph-caret-right"></i></button>
                        </div>
                    
                        <div class="calendar__week week">
                            <div class="calendar__week-text">Su</div>
                            <div class="calendar__week-text">Mo</div>
                            <div class="calendar__week-text">Tu</div>
                            <div class="calendar__week-text">We</div>
                            <div class="calendar__week-text">Th</div>
                            <div class="calendar__week-text">Fr</div>
                            <div class="calendar__week-text">Sa</div>
                        </div>
                        <div class="days"></div>
                    </div>
                </div>
            </div>
            <!-- Calendar End -->
            
       
        </div>

    </div>
</div>



@section('scripts')
<!--js code here-->
  <!-- file upload -->
  <script src="{{ asset('public/assets/js/plyr.js') }}"></script>
  <!-- full calendar -->
  <script src="{{ asset('public/assets/js/full-calendar.js') }}"></script>
  <!-- jQuery UI -->
  <script src="{{ asset('public/assets/js/jquery-ui.js') }}"></script>
  <!-- jQuery UI -->
  <script src="{{ asset('public/assets/js/editor-quill.js') }}"></script>
  <!-- apex charts -->
  <script src="{{ asset('public/assets/js/apexcharts.min.js') }}"></script>
  <!-- Calendar Js -->
  <script src="{{ asset('public/assets/js/calendar.js') }}"></script>
  <!-- jvectormap Js -->
  <script src="{{ asset('public/assets/js/jquery-jvectormap-2.0.5.min.js') }}"></script>
  <!-- jvectormap world Js -->
  <script src="{{ asset('public/assets/js/jquery-jvectormap-world-mill-en.js') }}"></script>
  
<script type="text/javascript">

function createChart(chartId, chartColor) {

let currentYear = new Date().getFullYear();

var options = {
series: [
    {
        name: 'series1',
        data: [18, 25, 22, 40, 34, 55, 50, 60, 55, 65],
    },
],
chart: {
    type: 'area',
    width: 80,
    height: 42,
    sparkline: {
        enabled: true // Remove whitespace
    },

    toolbar: {
        show: false
    },
    padding: {
        left: 0,
        right: 0,
        top: 0,
        bottom: 0
    }
},
dataLabels: {
    enabled: false
},
stroke: {
    curve: 'smooth',
    width: 1,
    colors: [chartColor],
    lineCap: 'round'
},
grid: {
    show: true,
    borderColor: 'transparent',
    strokeDashArray: 0,
    position: 'back',
    xaxis: {
        lines: {
            show: false
        }
    },   
    yaxis: {
        lines: {
            show: false
        }
    },  
    row: {
        colors: undefined,
        opacity: 0.5
    },  
    column: {
        colors: undefined,
        opacity: 0.5
    },  
    padding: {
        top: 0,
        right: 0,
        bottom: 0,
        left: 0
    },  
},
fill: {
    type: 'gradient',
    colors: [chartColor], // Set the starting color (top color) here
    gradient: {
        shade: 'light', // Gradient shading type
        type: 'vertical',  // Gradient direction (vertical)
        shadeIntensity: 0.5, // Intensity of the gradient shading
        gradientToColors: [`${chartColor}00`], // Bottom gradient color (with transparency)
        inverseColors: false, // Do not invert colors
        opacityFrom: .5, // Starting opacity
        opacityTo: 0.3,  // Ending opacity
        stops: [0, 100],
    },
},
// Customize the circle marker color on hover
markers: {
    colors: [chartColor],
    strokeWidth: 2,
    size: 0,
    hover: {
        size: 8
    }
},
xaxis: {
    labels: {
        show: false
    },
    categories: [`Jan ${currentYear}`, `Feb ${currentYear}`, `Mar ${currentYear}`, `Apr ${currentYear}`, `May ${currentYear}`, `Jun ${currentYear}`, `Jul ${currentYear}`, `Aug ${currentYear}`, `Sep ${currentYear}`, `Oct ${currentYear}`, `Nov ${currentYear}`, `Dec ${currentYear}`],
    tooltip: {
        enabled: false,
    },
},
yaxis: {
    labels: {
        show: false
    }
},
tooltip: {
    x: {
        format: 'dd/MM/yy HH:mm'
    },
},
};

var chart = new ApexCharts(document.querySelector(`#${chartId}`), options);
chart.render();
}

// Call the function for each chart with the desired ID and color
createChart('complete-course', '#2FB2AB');
createChart('earned-certificate', '#27CFA7');
createChart('course-progress', '#6142FF');
createChart('community-support', '#FA902F');



</script>

{{-- DATA TABLE --}}

@endsection

@endsection