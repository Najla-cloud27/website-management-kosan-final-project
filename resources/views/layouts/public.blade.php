<!DOCTYPE html>
<html lang="id">
<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Kosan DiriQ by Najla">
    <meta name="description" content="Kosan DiriQ - Sistem Manajemen Kosan Modern dan Terpercaya">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- ======== Page title ============ -->
    <title>@yield('title', 'Kosan DiriQ by Najla - Hunian Nyaman dan Terjangkau')</title>
    
    <!--<< Favcion >>-->
    <link rel="shortcut icon" href="{{ asset('travo/img/kosan-diriq-favicon.png') }}">
    
    <!--<< Bootstrap min.css >>-->
    <link rel="stylesheet" href="{{ asset('travo/css/bootstrap.min.css') }}">
    
    <!--<< All Min Css >>-->
    <link rel="stylesheet" href="{{ asset('travo/css/all.min.css') }}">
    
    <!--<< Animate.css >>-->
    <link rel="stylesheet" href="{{ asset('travo/css/animate.css') }}">
    
    <!--<< Magnific Popup.css >>-->
    <link rel="stylesheet" href="{{ asset('travo/css/magnific-popup.css') }}">
    
    <!--<< MeanMenu.css >>-->
    <link rel="stylesheet" href="{{ asset('travo/css/meanmenu.css') }}">
    
    <!--<< Swiper Bundle.css >>-->
    <link rel="stylesheet" href="{{ asset('travo/css/swiper-bundle.min.css') }}">
    
    <!--<< Nice Select.css >>-->
    <link rel="stylesheet" href="{{ asset('travo/css/nice-select.css') }}">
    
    <!--<< flacticon.css >>-->
    <link rel="stylesheet" href="{{ asset('travo/css/flacticon.css') }}">
    
    <!--<< Main.css >>-->
    <link rel="stylesheet" href="{{ asset('travo/css/main.css') }}">
    
    <!--<< Custom Blue Theme Override >>-->
    <link rel="stylesheet" href="{{ asset('travo/css/custom-blue-theme.css') }}">
    
    @stack('styles')
    @livewireStyles
</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader" class="preloader">
        <div class="animation-preloader">
            <div class="spinner"></div>
            <div class="txt-loading">
                <span data-text-preloader="K" class="letters-loading">K</span>
                <span data-text-preloader="O" class="letters-loading">O</span>
                <span data-text-preloader="S" class="letters-loading">S</span>
                <span data-text-preloader="A" class="letters-loading">A</span>
                <span data-text-preloader="N" class="letters-loading">N</span>
            </div>
            <p class="text-center">Loading</p>
        </div>
        <div class="loader">
            <div class="row">
                <div class="col-3 loader-section section-left"><div class="bg"></div></div>
                <div class="col-3 loader-section section-left"><div class="bg"></div></div>
                <div class="col-3 loader-section section-right"><div class="bg"></div></div>
                <div class="col-3 loader-section section-right"><div class="bg"></div></div>
            </div>
        </div>
    </div>

    <!--<< Mouse Cursor Start >>-->
    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>

    <!--<< Back-Top Start >>-->
    <button id="back-top" class="back-to-top">
        <i class="fa-regular fa-arrow-up"></i>
    </button>

    <!-- Offcanvas Area Start -->
    @include('layouts.public.offcanvas')

    <!-- Search Area Start -->
    @include('layouts.public.search')

    <!-- Header Start -->
    @include('layouts.public.header')

    <!-- Main Content -->
    <main>
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    <!-- Footer Start -->
    @include('layouts.public.footer')

    <!--<< All JS Plugins >>-->
    <script src="{{ asset('travo/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('travo/js/viewport.jquery.js') }}"></script>
    <script src="{{ asset('travo/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('travo/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('travo/js/jquery.waypoints.js') }}"></script>
    <script src="{{ asset('travo/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('travo/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('travo/js/jquery.meanmenu.min.js') }}"></script>
    <script src="{{ asset('travo/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('travo/js/wow.min.js') }}"></script>
    <script src="{{ asset('travo/js/main.js') }}"></script>

    @livewireScripts
    @stack('scripts')
</body>
</html>
