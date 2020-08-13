<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>{{ env('APP_NAME') }}</title>

    <script src="{{ mix('js/app.js') }}" defer></script>

    {{-- Style Section Start --}}
    @include('layouts.dashboard.panels.styles')
    {{-- Style Section End --}}
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
<div id="app">

    <div id="panel_header" style="display: none" 
    v-show=" $route.path === '/login' || $route.path === '/register' || $route.path === '/logout' || $route.path === '/forget/password' ? false : true "
    >
        {{-- Header Section Start --}}
        @include('layouts.dashboard.panels.header')
        {{-- Header Section End --}}
    </div>

    <div id="panel_menubar" style="display: none"
    v-show=" $route.path === '/login' || $route.path === '/register' || $route.path === '/logout' || $route.path === '/forget/password' ? false : true "
    >
        {{-- Main MenuBar Section Start --}}
        @include('layouts.dashboard.panels.menubar')
        {{-- Main MenuBar Section End --}}
    </div>

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
            {{-- Yeild Section Start --}}
            @yield('dashboard_content')
            {{-- Yeild Section End --}}
    </div>

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>


    <div id="panel_footer" style="display: none"
    v-show=" $route.path === '/login' || $route.path === '/register' || $route.path === '/logout' || $route.path === '/forget/password' ? false : true "
    >
        {{-- Footer Section Start --}}
        @include('layouts.dashboard.panels.footer')
        {{-- Footer Section End --}}
    </div>
</div>
    {{-- Script Section Start --}}
    @include('layouts.dashboard.panels.scripts')
    {{-- Script Section End --}}

<script>
    const token = localStorage.getItem('token');
    // const panel_header = document.getElementById('panel_header');
    // const panel_menubar = document.getElementById('panel_menubar');
    // const panel_footer = document.getElementById('panel_footer');
    // console.log(panel_header, panel_menubar, panel_footer);
    let isloggedIn = false;

    if(token)
    {
        isloggedIn = true;
        $("#panel_header").css("display", "");
        $("#panel_menubar").css("display", "");
        $("#panel_footer").css("display", "");
        // panel_header.style.display="none";
        // panel_menubar.style.display="none";
        // panel_footer.style.display="none";
    }
    else{
        isloggedIn = false;
    }
</script>
</body>
<!-- END: Body-->
</html>