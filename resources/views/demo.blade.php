@extends('layouts.dashboard.dashboard_app')
@section('dashboard_content')
<!-- BEGIN: Content-->
    <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
            <router-view></router-view>
        </div>
    </div>
    <!-- END: Content-->
@endsection