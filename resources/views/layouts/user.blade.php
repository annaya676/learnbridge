<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>LMS | Dashbord </title>

	<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ url('/') }}">
 
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('public/assets/images/logo/favicon.png') }}">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.min.css') }}">
    <!-- file upload -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/file-upload.css') }}">
    <!-- file upload -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/plyr.css') }}">
   <!-- full calendar -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/full-calendar.css') }}">
    <!-- jquery Ui -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/jquery-ui.css') }}">
    <!-- editor quill Ui -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/editor-quill.css') }}">
    <!-- apex charts Css -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/apexcharts.css') }}">
    <!-- calendar Css -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/calendar.css') }}">
    <!-- jvector map Css -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/jquery-jvectormap-2.0.5.css') }}">
    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/custom.css') }}">

    
	@yield('styles')
    <style type="text/css">

        body {
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .remove-margin{
            margin-inline-start: 0px !important
        }
    
        .text-justify {
            text-align: justify;
        }
    </style>
    

</head> 
<body>
    
<!--==================== Preloader Start ====================-->
  <div class="preloader">
    <div class="loader"></div>
  </div>
<!--==================== Preloader End ====================-->

<!--==================== Sidebar Overlay End ====================-->
<div class="side-overlay"></div>
<!--==================== Sidebar Overlay End ====================-->

    <!-- ============================ Sidebar Start ============================ -->


<aside class="sidebar">
    <!-- sidebar close btn -->
     <button type="button" class="sidebar-close-btn text-gray-500 hover-text-white hover-bg-main-600 text-md w-24 h-24 border border-gray-100 hover-border-main-600 d-xl-none d-flex flex-center rounded-circle position-absolute"><i class="ph ph-x"></i></button>
    <!-- sidebar close btn -->
    
    <a href="{{ route('user.home') }}" class="sidebar__logo text-center p-20 position-sticky inset-block-start-0 bg-white w-100 z-1 pb-10">
        <img src="{{ asset('public/assets/images/logo/logo.png') }}" alt="Logo">
    </a>

    <div class="sidebar-menu-wrapper overflow-y-auto scroll-sm">
        <div class="p-20 pt-10">
            
            <ul class="sidebar-menu">
                
                <li class="sidebar-menu__item has-dropdown {{  Request::is('course/*') ? 'activePage' : '' }}">
                    <a href="javascript:void(0)" class="sidebar-menu__link">
                        <img src="{{  asset('public/assets/images/new_icons/Courses.svg') }}" alt="Courses" class="h-32 w-32 rounded-circle">                     
                        <span class="text" style="text-transform: none;">Courses</span>
                    </a>
 
                    <!-- Submenu start -->
                    <ul class="sidebar-submenu">
                        @php
                            $privous=0;
                            $i=0;
                        @endphp
                        @foreach ($categoryData['categoryData'] as $key => $myCategory)
                        @if ($myCategory['course_count']>0)

                        @php

                        if($i==0){
                            $isActive = 1;
                            $privous  = $categoryData['course_completed_status'][$myCategory['category_id']];
                        }else if($privous==1){
                            $isActive =1;
                            $privous =$categoryData['course_completed_status'][$myCategory['category_id']];
                        }else{
                            $isActive =$categoryData['course_completed_status'][$myCategory['category_id']];
                            $privous =$categoryData['course_completed_status'][$myCategory['category_id']];
                        }
                        $i++;
                        @endphp
                        <li class="sidebar-submenu__item">
                            <a href="{{ $isActive==1?route('user.courses',$myCategory['category_id']):'javascript:void(0)' }}" class="sidebar-submenu__link">{{ $myCategory['category_subset'] }}</a>
                        </li>
                        @endif

                        @endforeach

                      
                    </ul>
                    <!-- Submenu End -->
                </li>

               
            </ul>
        </div>
     
    </div>

</aside>    
<!-- ============================ Sidebar End  ============================ -->

    <div class="dashboard-main-wrapper">
        <div class="top-navbar flex-between gap-16 top-header-bg">

    <div class="flex-align gap-16">
        <!-- Toggle Button Start -->
        <button type="button" class="toggle-btn d-xl-none d-flex text-26 text-gray-500"><i class="ph ph-list text-white"></i></button>
        <!-- Toggle Button End -->
        
        {{-- <form action="#" class="w-350 d-sm-block d-none">
            <div class="position-relative">
                <button type="submit" class="input-icon text-xl d-flex text-gray-100 pointer-event-none"><i class="ph ph-magnifying-glass"></i></button> 
                <input type="text" class="form-control ps-40 h-40 border-transparent focus-border-main-600 bg-main-50 rounded-pill placeholder-15" placeholder="Search...">
            </div>
        </form> --}}
    </div>

    <div class="flex-align gap-16">
        <div class="flex-align gap-8">
            <!-- Notification Start -->
            <div class="dropdown">
                <button class="dropdown-btn shaking-animation text-gray-500 w-40 h-40 bg-main-50 hover-bg-main-100 transition-2 rounded-circle text-xl flex-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="position-relative">
                        <i class="ph ph-bell"></i>
                        <span class="alarm-notify position-absolute end-0"></span>
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu--lg border-0 bg-transparent p-0">
                    <div class="card border border-gray-100 rounded-12 box-shadow-custom p-0 overflow-hidden">
                        <div class="card-body p-0">
                            <div class="py-8 px-24 bg-main-600">
                                <div class="flex-between">
                                    <h5 class="text-xl fw-semibold text-white mb-0">Notifications</h5>
                                    <div class="flex-align gap-12">
                                        <button type="button" class="bg-white rounded-6 text-sm px-8 py-2 hover-text-primary-600"> New </button>
                                        <button type="button" class="close-dropdown hover-scale-1 text-xl text-white"><i class="ph ph-x"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="p-24 max-h-270 overflow-y-auto scroll-sm">
                                <div class="d-flex align-items-start gap-12">
                                    <img src="{{ asset('public/assets/images/thumbs/notification-img1.png') }}" alt="" class="w-48 h-48 rounded-circle object-fit-cover">
                                    <div class="border-bottom border-gray-100 mb-24 pb-24">
                                        <div class="flex-align gap-4">
                                            <a href="#" class="fw-medium text-15 mb-0 text-gray-300 hover-text-main-600 text-line-2">Ashwin Bose is requesting access to Design File - Final Project. </a>
                                            <!-- Three Dot Dropdown Start -->
                                            <div class="dropdown flex-shrink-0">
                                                <button class="text-gray-200 rounded-4" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ph-fill ph-dots-three-outline"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu--md border-0 bg-transparent p-0">
                                                    <div class="card border border-gray-100 rounded-12 box-shadow-custom">
                                                        <div class="card-body p-12">
                                                            <div class="max-h-200 overflow-y-auto scroll-sm pe-8">
                                                                <ul>
                                                                    <li class="mb-0">
                                                                        <a href="#" class="py-6 text-15 px-8 hover-bg-gray-50 text-gray-300 rounded-8 fw-normal text-xs d-block">
                                                                            <span class="text">Mark as read</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="mb-0">
                                                                        <a href="#" class="py-6 text-15 px-8 hover-bg-gray-50 text-gray-300 rounded-8 fw-normal text-xs d-block">
                                                                            <span class="text">Delete Notification</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="mb-0">
                                                                        <a href="#" class="py-6 text-15 px-8 hover-bg-gray-50 text-gray-300 rounded-8 fw-normal text-xs d-block">
                                                                            <span class="text">Report</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Three Dot Dropdown End -->
                                        </div>
                                        <div class="flex-align gap-6 mt-8">
                                            <img src="{{ asset('public/assets/images/icons/google-drive.png') }}" alt="">
                                            <div class="flex-align gap-4">
                                                <p class="text-gray-900 text-sm text-line-1">Design brief and ideas.txt</p>
                                                <span class="text-xs text-gray-200 flex-shrink-0">2.2 MB</span>
                                            </div>
                                        </div>
                                        <div class="mt-16 flex-align gap-8">
                                            <button type="button" class="btn btn-main py-8 text-15 fw-normal px-16">Accept</button>
                                            <button type="button" class="btn btn-outline-gray py-8 text-15 fw-normal px-16">Decline</button>
                                        </div>
                                        <span class="text-gray-200 text-13 mt-8">2 mins ago</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start gap-12">
                                    <img src="{{ asset('public/assets/images/thumbs/notification-img2.png') }}" alt="" class="w-48 h-48 rounded-circle object-fit-cover">
                                    <div class="">
                                        <a href="#" class="fw-medium text-15 mb-0 text-gray-300 hover-text-main-600 text-line-2">Patrick added a comment on Design Assets - Smart Tags file:</a>
                                        <span class="text-gray-200 text-13">2 mins ago</span>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="py-13 px-24 fw-bold text-center d-block text-primary-600 border-top border-gray-100 hover-text-decoration-underline"> View All </a>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Notification Start -->
           
        </div>


        <!-- User Profile Start -->
        <div class="dropdown">
            <button class="users arrow-down-icon border border-gray-200 bg-main-50 hover-bg-main-100 rounded-pill p-4 d-inline-block pe-40 position-relative" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="position-relative">
                    <img src="{{ asset('public/assets/images/user.png') }}" alt="Image" class="h-32 w-32 rounded-circle">
                    <span class="activation-badge w-8 h-8 position-absolute inset-block-end-0 inset-inline-end-0"></span>
                </span>
            </button>
            <div class="dropdown-menu dropdown-menu--lg border-0 bg-transparent p-0">
                <div class="card border border-gray-100 rounded-12 box-shadow-custom">
                    <div class="card-body">
                        <div class="flex-align gap-8 mb-0 pb-20 border-bottom border-gray-100">
                            <img src="{{  asset('public/assets/images/user.png') }}" alt="profile" class="w-54 h-54 rounded-circle">
                            <div class="">
                                <h4 class="mb-0">{{ Auth::guard('web')->user()->name ?Auth::guard('web')->user()->name:''}}</h4>
                                <p class="fw-medium text-13 text-gray-200">{{ Auth::guard('web')->user()->email ?Auth::guard('web')->user()->email:''}}</p>
                            </div>
                        </div>
                        <ul class="max-h-270 overflow-y-auto scroll-sm pe-4">
                          
                            <li class="pt-8 border-gray-100">
                                <a href="{{ route('logout') }}" class="py-12 text-15 px-20 hover-bg-danger-50 text-gray-300 hover-text-danger-600 rounded-8 flex-align gap-8 fw-medium text-15">
                                    <span class="text-2xl text-danger-600 d-flex"><i class="ph ph-sign-out"></i></span>
                                    <span class="text">Log Out</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- User Profile Start -->

    </div>
</div>

        @if (Auth::guard('web')->user())
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center breaking-news">
                        <marquee class="news-scroll" behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();"> 
                            @php
                                $doj = Auth::guard('web')->user()->doj;
                            @endphp
                            <a class=" text-red" href="#">Please submit all assignments before - {{  \Carbon\Carbon::create($doj)->subDays(5)->format('d-m-Y') }}</a> 
                        </marquee>
                    </div>
                </div>
            </div>
        </div>
        @endif

         <!-- Main Content Area Start -->
        @yield('content')
        <!-- Main Content Area End -->
       
    </div>
    
   
    <!-- Welcome Modal -->
    <div class="modal fade" id="welcomeModal" tabindex="-1" aria-labelledby="welcomeModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header no-underline" style=" border-bottom: none; ">
                    <h5 class="modal-title" id="welcomeModalLabel">Dear {{ Auth::guard('web')->user()->name ?Auth::guard('web')->user()->name:''}},</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="closeWelcomeModal" aria-label="Close"></button>
                </div>
                    <div class="modal-body text-justify ">
                    <p>Welcome to Evalueserve!</p>
                    <br/>
                    <p>We are delighted to have you join our team. We are committed to fostering a collaborative and innovative work environment. As part of your onboarding journey, we are excited to introduce you to our comprehensive training tool, designed to support your professional growth and development. This training is an important part of your joining process and is mandated to be completed before you officially start with us.</p>
                    <br/>
                    <p>Please be mindful of privacy and security; do not share your password with anyone. For any questions regarding your joining or learning plan, feel free to write to us at <New DL>.</p>
                        <br/>
                    <p>We look forward to your contributions and are confident that you will find your experience at Evalueserve both rewarding and fulfilling.</p>
                        <br/> <br/>
                    <p>Let your learning journey begin!</p>
                    </div>

            </div>
        </div>
    </div>

    <!-- Terms and Conditions Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header no-underline" style=" border-bottom: none; ">
                    <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                </div>
                <div class="modal-body text-justify ">
                    <p>                   
Until recently, the prevailing view assumed lorem ipsum was born as a nonsense text. “It’s not Latin, though it looks like it, and it actually says nothing,” Before & After magazine answered a curious reader, “Its ‘words’ loosely approximate the frequency with which letters occur in English, which is why at a glance it looks pretty real.”
                    </p>
     <p>
As Cicero would put it, “Um, not so fast.”
</p>
<p>
The placeholder text, beginning with the line “Lorem ipsum dolor sit amet, consectetur adipiscing elit”, looks like Latin because in its youth, centuries ago, it was Latin.
</p>
<p>
Richard McClintock, a Latin scholar from Hampden-Sydney College, is credited with discovering the source behind the ubiquitous filler text. In seeing a sample of lorem ipsum, his interest was piqued by consectetur—a genuine, albeit rare, Latin word. Consulting a Latin dictionary led McClintock to a passage from De Finibus Bonorum et Malorum (“On the Extremes of Good and Evil”), a first-century B.C. text from the Roman philosopher Cicero.
</p>
<p>
In particular, the garbled words of lorem ipsum bear an unmistakable resemblance to sections 1.10.32–33 of Cicero’s work, with the most notable passage excerpted below:
</p>
<p>
“Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.”
</p>
<p>
A 1914 English translation by Harris Rackham reads:
</p>
<p>
“Nor is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but occasionally circumstances occur in which toil and pain can procure him some great pleasure.”
</p>
<p>
McClintock’s eye for detail certainly helped narrow the whereabouts of lorem ipsum’s origin, however, the “how and when” still remain something of a mystery, with competing theories and timelines.
</p>

                    <br/>
                    <form id="termsForm" class="needs-validation" novalidate>
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" id="agreeTerms" required>

                            <label class="form-check-label" for="agreeTerms">
                                I agree to the terms and conditions
                            </label>

                        </div>
                        <div class="text-danger terms-error"></div> 

                    </form>
                </div>
                <div class="modal-footer" style=" border-top: none;">
                    <button type="button" class="btn btn-main rounded-pill py-9" id="submitTerms">Submit</button>
                </div>
            </div>
        </div>
    </div>



        <!-- Jquery js -->
    <script src="{{ asset('public/assets/js/jquery-3.7.1.min.js') }}"></script>
    <!-- Bootstrap Bundle Js -->
    <script src="{{ asset('public/assets/js/boostrap.bundle.min.js') }}"></script>
    <!-- Phosphor Js -->
    <script src="{{ asset('public/assets/js/phosphor-icon.js') }}"></script>
    <!-- file upload -->
    <script src="{{ asset('public/assets/js/file-upload.js') }}"></script>

    <!-- main js -->
    <script src="{{ asset('public/assets/js/main.js') }}"></script>

    @yield('scripts')


    @if (Auth::guard('web')->user()->isterm!=1)

        <script>
            $(document).ready(function () {
                    // Show welcome modal
                    var welcomeModal = new bootstrap.Modal(document.getElementById('welcomeModal'));
                    welcomeModal.show();

                    // When welcome modal is closed, show terms modal
                    $('#closeWelcomeModal').on('click', function () {
                        welcomeModal.hide();
                        var termsModal = new bootstrap.Modal(document.getElementById('termsModal'));
                        termsModal.show();
                    });

                // Handle Terms & Conditions form submission
                $('#submitTerms').on('click', function () {
                    if ($('#agreeTerms').is(':checked')) {
                        // Hide terms modal and mark terms as accepted (optional: make AJAX call)
                        $('#termsModal').modal('hide');
                        $.ajax({
                            url: "{{ route('acceptTerms') }}",
                            method: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                isterm: 1,
                            }
                        });
                    } else {
                       $('.terms-error').html("You must agree to the terms and conditions to continue.");
                    }
                });
            });
        </script>

    @endif


    <script>
        document.addEventListener('contextmenu', event => event.preventDefault());
    </script>
	
    </body>
</html>