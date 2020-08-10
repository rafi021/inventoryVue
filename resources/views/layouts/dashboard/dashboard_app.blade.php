<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>{{ env('APP_NAME') }}</title>

    {{-- Style Section Start --}}
    @include('layouts.dashboard.panels.styles')
    {{-- Style Section End --}}
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
<div id="app">
    {{-- Header Section Start --}}
    @include('layouts.dashboard.panels.header')
    {{-- Header Section End --}}

    {{-- Main MenuBar Section Start --}}
    @include('layouts.dashboard.panels.menubar')
    {{-- Main MenuBar Section End --}}

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        {{-- Yeild Section Start --}}
        @yield('dashboard_content')
        {{-- Yeild Section End --}}
    </div>

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    {{-- Footer Section Start --}}
    @include('layouts.dashboard.panels.footer')
</div>
    {{-- Footer Section End --}}
    {{-- Script Section Start --}}
    @include('layouts.dashboard.panels.scripts')
    {{-- Script Section End --}}

</body>
<!-- END: Body-->

</html>