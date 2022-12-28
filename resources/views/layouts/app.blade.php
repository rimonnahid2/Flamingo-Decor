<!doctype html>
<html lang="zxx">
    <head>
        <!-- Required Meta Tags -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap CSS --> 
        <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/bootstrap.min.css') }}">
        <!-- Animate Min CSS -->
        <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/animate.min.css') }}">
        <!-- Flaticon CSS -->
        <link rel="stylesheet" href="{{ asset('public/frontend/assets/fonts/flaticon.css') }}">
        <!-- Boxicons CSS -->
        <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/boxicons.min.css') }}">
        <!-- Owl Carousel Min CSS --> 
        <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/owl.theme.default.min.css') }}">
        <!-- Nice Select Min CSS --> 
        <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/nice-select.min.css') }}">
        <!-- Meanmenu CSS -->
        <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/meanmenu.css') }}">
        <!-- Style CSS -->
        <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/style.css') }}">
        <!-- Responsive CSS -->
         <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/responsive.css') }} ">
                <!-- Theme Dark CSS -->
               <link rel="stylesheet" href="{{asset('public/frontend/assets/css/theme-dark.css')}}">


        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{asset('public/frontend/assets/images/favicon.png')}}">

        <title>Hilo - Organic Food Shop HTML Template</title>
    </head>
    <body>
        @include('layouts.header')

        @yield('content')

        @include('layouts.footer')


        <!-- Jquery Min JS -->
        <script src="{{asset('public/frontend/assets/js/jquery.min.js')}}"></script>
        <!-- Bootstrap Min JS -->
        <script src="{{asset('public/frontend/assets/js/bootstrap.bundle.min.js')}}"></script>
        <!-- Owl Carousel Min JS -->
        <script src="{{asset('public/frontend/assets/js/owl.carousel.min.js')}}"></script>
        <!-- Nice Select Min JS -->
        <script src="{{asset('public/frontend/assets/js/jquery.nice-select.min.js')}}"></script>
        <!-- Wow Min JS -->
        <script src="{{asset('public/frontend/assets/js/wow.min.js')}}"></script>
        <!-- Meanmenu JS -->
        <script src="{{asset('public/frontend/assets/js/meanmenu.js')}}"></script>
        <!-- Jquery Ui Min JS -->
        <script src="{{asset('public/frontend/assets/js/jquery-ui.min.js')}}"></script>
        <!-- Ajaxchimp Min JS -->
        <script src="{{asset('public/frontend/assets/js/jquery.ajaxchimp.min.js')}}"></script>
        <!-- Form Validator Min JS -->
        <script src="{{asset('public/frontend/assets/js/form-validator.min.js')}}"></script>
        <!-- Contact Form JS -->
        <script src="{{asset('public/frontend/assets/js/contact-form-script.js')}}"></script>
        <!-- Mixitup Min JS -->
       <script src="{{asset(' public/frontend/assets/js/mixitup.min.js')}}"></script>
                <!-- Custom JS -->
        <script src="{{asset('public/frontend/assets/js/custom.js')}}"></script>

    </body>
</html>