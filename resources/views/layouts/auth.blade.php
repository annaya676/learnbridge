<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>LMS | Login</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('public/assets/images/logo/favicon.png') }}">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.min.css') }}">
    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/main.css') }}">

    @yield('styles')


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

    <section class="auth d-flex">
        <div class="auth-left bg-main-50 flex-center p-24">
            <img src="{{ asset('public/assets/images/thumbs/auth-img.jpg') }}" alt="">
        </div>
        <div class="auth-right py-40 px-24 flex-center flex-column">


            @yield('content')
        

        </div>
    </section>
        <!-- Jquery js -->
    <script src="{{ asset('public/assets/js/jquery-3.7.1.min.js') }}"></script>
    <!-- Bootstrap Bundle Js -->
    <script src="{{ asset('public/assets/js/boostrap.bundle.min.js') }}"></script>
    <!-- Phosphor Js -->
    <script src="{{ asset('public/assets/js/phosphor-icon.js') }}"></script>
 
    <!-- main js -->
    <script src="{{ asset('public/assets/js/main.js') }}"></script>
    
    @yield('scripts')


    </body>
</html>