
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{asset('public/backend/assets/images/favicon-32x32.png')}}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('public/backend/assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
    <link href="{{ asset('public/backend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
    <link href="{{ asset('public/backend/assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('public/backend/assets/css/pace.min.css')}}" rel="stylesheet" />
    <script src="{{ asset('public/backend/assets/js/pace.min.js')}}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('public/backend/assets/css/bootstrap.min.cs')}}s" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('public/backend/assets/css/app.css')}}" rel="stylesheet">
    <link href="{{ asset('public/backend/assets/css/icons.css')}}" rel="stylesheet">
    <title>@yield('authtitle')</title>
</head>

<body class="bg-login">
    <!--wrapper-->
    <div class="wrapper">
        <header class="login-header shadow">
            <nav class="navbar navbar-expand-lg navbar-light bg-white rounded fixed-top rounded-0 shadow-sm">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img src="assets/images/logo-img.png" width="140" alt="" />
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent1">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item"> <a class="nav-link active" aria-current="page" href="{{ route('/') }}"><i class='bx bx-home-alt me-1'></i>Home</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link" href="#"><i class='bx bx-user me-1'></i>About </a>
                            </li>
                            <li class="nav-item"> <a class="nav-link" href="#"><i class='bx bx-category-alt me-1'></i>Contact</a>
                            </li>
                            @guest
                            @else

                            <li class="nav-item"> <a class="nav-link" href="{{ route('dashboard') }}"><i class='bx bx-microphone me-1'></i>Dashboard</a>
                                @endguest
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
            @yield('content')
        <footer class="bg-white shadow-sm border-top p-2 text-center fixed-bottom">
            <p class="mb-0">Copyright © 2021. All right reserved.</p>
        </footer>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="{{asset('public/backend/assets/js/bootstrap.bundle.min.js')}}"></script>
    <!--plugins-->
    <script src="{{asset('public/backend/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('public/backend/assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
    <script src="{{asset('public/backend/assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
    <script src="{{asset('public/backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
    <!--Password show & hide js -->
    <script>
        $(document).ready(function () {
            $("#show_hide_password a").on('click', function (event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
    <!--app JS-->
    <script src="{{asset('public/backend/assets/js/app.js')}}"></script>
</body>

</html>



