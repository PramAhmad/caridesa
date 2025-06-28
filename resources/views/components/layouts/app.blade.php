<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="Riho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities." />
    <meta name="keywords"
        content="admin template, Riho admin template, dashboard template, flat admin template, responsive admin template, web app" />
    <meta name="author" content="pixelstrap" />
    <link rel="icon" href="{{ asset('tenant/images/favicon.png') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('tenant/images/favicon.png') }}" type="image/x-icon" />
    <title>{{ config('app.name', 'Laravel') }}{{ isset($title) ? ' - ' . $title : '' }}</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&amp;display=swap" rel="stylesheet" />
    @stack('css_before')
    <link rel="stylesheet" href="{{ asset('tenant/css/font-awesome.css'); }}"/>
    <link rel="stylesheet" href="{{ asset('tenant/css/vendors/icofont.css'); }}"/>
    <link rel="stylesheet" href="{{ asset('tenant/css/vendors/themify.css'); }}"/>
    <link rel="stylesheet" href="{{ asset('tenant/css/vendors/flag-icon.css'); }}"/>
    <link rel="stylesheet" href="{{ asset('tenant/css/vendors/feather-icon.css'); }}"/>
    <link rel="stylesheet" href="{{ asset('tenant/css/vendors/slick.css'); }}"/>
    <link rel="stylesheet" href="{{ asset('tenant/css/vendors/slick-theme.css'); }}"/>
    <link rel="stylesheet" href="{{ asset('tenant/css/vendors/scrollbar.css'); }}"/>
    <link rel="stylesheet" href="{{ asset('tenant/css/vendors/animate.css'); }}"/>
    <link rel="stylesheet" href="{{ asset('tenant/css/vendors/prism.css'); }}"/>
    <link rel="stylesheet" href="{{ asset('tenant/css/vendors/bootstrap.css'); }}"/>
    <link rel="stylesheet" href="{{ asset('tenant/css/style.css'); }}"/>
    <link id="color" rel="stylesheet" href="{{ asset('tenant/css/color-3.css'); }}" media="screen" />
    <link rel="stylesheet" href="{{ asset('tenant/css/responsive.css'); }}"/>
    @stack('css')
</head>

<body>
    <div class="loader-wrapper">
        <div class="loader">
            <div class="loader4"></div>
        </div>
    </div>
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        @include('components.layouts.header')
        
        <div class="page-body-wrapper horizontal-menu">
            @include('components.layouts.sidebar')

            <div class="page-body">
                {{ $slot }}
            </div>
            
            @include('components.layouts.footer')
        </div>
    </div>

    <script src="{{ asset('tenant/js/jquery.min.js') }}"></script>
    <script src="{{ asset('tenant/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('tenant/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('tenant/js/icons/feather-icon/feather-icon.js') }}"></script>
    <script src="{{ asset('tenant/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('tenant/js/scrollbar/custom.js') }}"></script>
    <script src="{{ asset('tenant/js/config.js') }}"></script>
    <script src="{{ asset('tenant/js/sidebar-pin.js') }}"></script>
    <script src="{{ asset('tenant/js/slick/slick.min.js') }}"></script>
    <script src="{{ asset('tenant/js/slick/slick.js') }}"></script>
    <script src="{{ asset('tenant/js/header-slick.js') }}"></script>
    <script src="{{ asset('tenant/js/prism/prism.min.js') }}"></script>
    <script src="{{ asset('tenant/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('tenant/js/typeahead-search/handlebars.js') }}"></script>
    <script src="{{ asset('tenant/js/script.js') }}"></script>
    @stack('script')
</body>

</html>
