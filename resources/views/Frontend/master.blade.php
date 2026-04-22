<!DOCTYPE html>
<html lang="en">
@php
    $menuData = cache('main-menu') ?? [];
    $template = $menuData['template'] ?? (object) [];
    $mainMenus = $menuData['main_menu_all'] ?? [];
@endphp

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ $template->title }}</title>
    <meta name="description" content="{{ $template->title }},{{ $template->detail }}">
    <meta name="keywords"
        content="{{ $template->title }},{{ $template->title_eng }},{{ $template->title_short }},{{ $template->title_short_eng }},{{ $template->email }},{{ $template->facebook }}">
    <meta name="author" content="{{ $template->title }}">

    <!-- Favicons -->
    <link href="{{ asset('assets_f/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets_f/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets_f/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_f/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_f/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_f/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_f/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets_f/css/main.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: FlexBiz
  * Template URL: https://bootstrapmade.com/flexbiz-bootstrap-business-template/
  * Updated: Aug 04 2025 with Bootstrap v5.3.7
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="starter-page-page">

    @include('Frontend.menu')

    <main class="main">
        @yield('content')
    </main>

    @include('Frontend.footer')



    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets_f/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets_f/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets_f/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets_f/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets_f/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets_f/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('assets_f/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets_f/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets_f/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets_f/js/main.js') }}"></script>

</body>

</html>
