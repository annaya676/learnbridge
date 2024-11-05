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
    <!-- dataTables -->
    <link rel="stylesheet" href="{{ asset('public/assets/dataTables/dataTables.dataTables.min.css') }}">
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
    <!-- select2  css -->
    <link rel="stylesheet" href="{{ asset('public/assets/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/assets/select2/css/select2-bootstrap-5-theme.min.css') }}" />

    
	@yield('styles')
    <style type="text/css">
        .remove-margin{
        margin-inline-start: 0px !important
        }
        .sidebar-hide{
        margin-inline-start: auto !important
        }
        /* SELECT2 */
        .selection { 
        width: 100%;
        }
        .sidebar-menu__item.activePage .sidebar-menu__link {
        /* background-color: hsl(var(--main)); */
        background-color: #87409d;
        /* color: hsl(var(--white)); */
        }
        .top-header-bg{
        background-color: #43224D;
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
        
        <a href="{{ route('dashboard') }}" class="sidebar__logo text-center p-20 position-sticky inset-block-start-0 bg-white w-100 z-1 pb-10">
            <img src="{{ asset('public/assets/images/logo/logo.png') }}" alt="Logo">
        </a>

        <div class="sidebar-menu-wrapper overflow-y-auto scroll-sm">
            <div class="p-20 pt-10">
                <ul class="sidebar-menu">
                    
                    @if ( auth('admin')->user()->role_id ==1 )
                        @include('includes.roles.admin')
                    @elseif ( auth('admin')->user()->role_id ==2)
                        @include('includes.roles.sme')
                    @else
                        @include('includes.roles.ta')
                    @endif
                
                </ul>
            </div>
        
        </div>

    </aside>    
    <!-- ============================ Sidebar End  ============================ -->

    <div class="dashboard-main-wrapper" >
        <div class="top-navbar flex-between gap-16 top-header-bg" >

            <div class="flex-align gap-16" >
                <!-- Toggle Button Start -->

                <button type="button" class="toggle-btn d-flex text-26 text-gray-500"><span class="text-white">X</span></button>
                {{-- <button type="button" class="toggle-btn d-flex text-26 text-gray-500"><i class="ph ph-list text-white"></i></button> --}}
                <button type="button" class="sidebar-show-btn d-xl-none d-flex text-26 text-gray-500"><i class="ph ph-list text-white"></i></button>
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
                   
                    <!-- Notification Start -->    
                </div>
                <!-- User Profile Start -->
                <div class="dropdown">
                    <button class="users arrow-down-icon border bg-main-50 hover-bg-main-100 border-gray-200 rounded-pill p-4 d-inline-block pe-40 position-relative" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="position-relative">
                            <img src="{{ asset('public/assets/images/user.png') }}" alt="Image" class="h-32 w-32 rounded-circle">
                            <span class="activation-badge w-8 h-8 position-absolute inset-block-end-0 inset-inline-end-0"></span>
                        </span>                    </button>
                    <div class="dropdown-menu dropdown-menu--lg  text-white border-0 bg-transparent p-0">
                        <div class="card border border-gray-100 rounded-12 box-shadow-custom">
                            <div class="card-body">
                                <div class="flex-align gap-8 mb-20 pb-20 border-bottom border-gray-100">
                                    <img src="{{  asset('public/assets/images/user.png') }}" alt="profile" class="w-54 h-54 rounded-circle">
                                    <div class="">
                                        <h4 class="mb-0">{{ Auth::guard('admin')->user()->name ?Auth::guard('admin')->user()->name:''}}</h4>
                                        <p class="fw-medium text-13 text-gray-200">{{ Auth::guard('admin')->user()->email ?Auth::guard('admin')->user()->email:''}}</p>
                                    </div>
                                </div>
                                <ul class="max-h-270 overflow-y-auto scroll-sm pe-4">
                                    <li class="mb-4">
                                        <a href="{{ route('profile') }}" class="py-12 text-15 px-20 hover-bg-gray-50 text-gray-300 rounded-8 flex-align gap-8 fw-medium text-15">
                                            <span class="text-2xl text-primary-600 d-flex"><i class="ph ph-gear"></i></span>
                                            <span class="text">Account Settings</span>
                                        </a>
                                    </li>
                                
                                    <li class="pt-8 border-top border-gray-100">
                                        <a href="{{ route('admin.logout') }}" class="py-12 text-15 px-20 hover-bg-danger-50 text-gray-300 hover-text-danger-600 rounded-8 flex-align gap-8 fw-medium text-15">
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

        <!-- Main Content Area Start -->
        @yield('content')
        <!-- Main Content Area End -->
       
    </div>
    
        <!-- Jquery js -->
    <script src="{{ asset('public/assets/js/jquery-3.7.1.min.js') }}"></script>
    <!-- Bootstrap Bundle Js -->
    <script src="{{ asset('public/assets/js/boostrap.bundle.min.js') }}"></script>
    <!-- Phosphor Js -->
    <script src="{{ asset('public/assets/js/phosphor-icon.js') }}"></script>
    <!-- file upload -->
    <script src="{{ asset('public/assets/js/file-upload.js') }}"></script>
    <!-- dataTables -->
    <script src="{{ asset('public/assets/dataTables/dataTables.min.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('public/assets/js/main.js') }}"></script>
    <script src="{{ asset('public/assets/select2/js/select2.min.js') }}"></script>

    @yield('scripts')
    
    <script>
        $( '.select2' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,
        } );
    </script>
        
        
    </body>
</html>