<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <title>Laravel</title>


    {{-- 
    php artisan config:clear
    php artisan cache:clear
    php artisan view:clear 
    --}}

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="icon" href={{ asset('medcare-master/img/favicon.png') }} type="image/png">

    <title>Medcare Medical</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('medcare-master/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('medcare-master/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('medcare-master/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('medcare-master/vendors/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('medcare-master/vendors/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('medcare-master/vendors/animate-css/animate.css') }}">
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset('medcare-master/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('medcare-master/css/responsive.css') }}">


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('medcare-master/js/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('medcare-master/js/popper.js') }}"></script>
    <script src="{{ asset('medcare-master/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('medcare-master/js/stellar.js') }}"></script>
    <script src="{{ asset('medcare-master/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('medcare-master/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('medcare-master/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('medcare-master/js/mail-script.js') }}"></script>
    <script src="{{ asset('medcare-master/js/contact.js') }}"></script>
    <script src="{{ asset('medcare-master/js/jquery.form.js') }}"></script>
    <script src="{{ asset('medcare-master/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('medcare-master/js/theme.js') }}"></script>



</head>

<body>


    <!--================Header Menu Area =================-->
    <header class="header_area">
        <div class="top_menu row m0">
            <div class="container">
                <div class="float-left">
                    <a class="dn_btn" href="https://mail.google.com/mail/?view=cm&fs=1&to=medical@example.com"
                        target="_blank">
                        <i class="bi bi-envelope"></i> medical@example.com
                    </a>
                    <a href="https://maps.google.com?q=123+Medical+Street+City" class="dn_btn"> <i
                            class="bi bi-geo-alt"></i>Trouver notre emplacement</a>
                </div>
                <div class="float-right">
                    <ul class="list header_social">
                        <li><a href="#"><i class="bi bi-facebook"></i></a></li>
                        <li><a href="#"><i class="bi bi-twitter-x"></i></a></li>
                        <li><a href="#"><i class="bi bi-linkedin"></i></a></li>
                        <li><a href="#"><i class="bi bi-skype"></i></a></li>
                        <li><a href="#"><i class="bi bi-vimeo"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="main_menu navbar-fixed-top">
            <nav class="navbar navbar-expand-lg navbar-light ">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="{{ route('/') }}"><img
                            src="{{ asset('medcare-master/img/logo.png') }}" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item"><a class="nav-link" href="{{ route('/') }}"></i>Acceuil</a></li>
                            @if (Auth::check())
                                <li class="nav-item">
                                    <a class="nav-link fw-bold text-primary" href="{{ route('dashboard') }}">
                                        <i class="bi bi-speedometer2"></i> Tableau de bord
                                    </a>
                                </li>
                            @else
                                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Inscription</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Se connecter</a>
                                </li>
                            @endif
                            <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <div class="py-3">
        @yield('navbar')
    </div>

    {{-- 
        php artisan config:clear
        php artisan cache:clear
        php artisan view:clear 
        --}}

</body>

</html>
