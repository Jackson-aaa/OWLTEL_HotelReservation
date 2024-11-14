@extends('layouts.main')
@section('title', 'Admin Owltel')

@section('cssStyles')
    <link rel="stylesheet" href="{{asset('css/admin/dashboard.css')}}">
@endsection

@section('jsScripts')
    <script src="{{asset('js/admin/dashboard.js')}}"></script>
@endsection

@section('content')
    <div class="main-content">
        <div id="sidebar" class="sidebar">
            <a id="logo" href="/"><img src="{{ asset('img/owl_logo.png') }}" alt="Logo"></a>
        
            <a href="{{ url(Request::path() . '/') }}" class="{{ Request::is('admin') || Request::is('admin/') || Request::is('admin/hotels')  ? 'sidebar-active' : '' }}">
                <div></div>
                <i class="fa fa-home" aria-hidden="true"></i><span>Hotels</span>
            </a>

            <a href="{{ url(Request::path() . '/locations') }}" class="{{ Request::is('admin/locations') ? 'sidebar-active' : '' }}">
                <div></div>
                <i class="fa-solid fa-location-dot"></i>Locations
            </a>

            <a href="{{ url(Request::path() . '/facilites') }}" class="{{ Request::is('admin/facilites') ? 'sidebar-active' : '' }}">
                <div></div>
                <i class="fa-solid fa-screwdriver-wrench"></i>Facilities
            </a>

            <a href="{{ url(Request::path() . '/payments') }}" class="{{ Request::is('admin/payments') ? 'sidebar-active' : '' }}">
                <div></div>
                <i class="fa-solid fa-money-bill-transfer"></i>Payments
            </a>

        </div>

        <!-- Page Content -->
        <div class="page-content">
            @yield('page-content')
        </div>
    </div>
@endsection