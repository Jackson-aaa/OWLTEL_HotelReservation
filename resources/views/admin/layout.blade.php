@extends('layouts.main')
@section('title', 'Admin Owltel')

@section('cssStyles')
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('jsScripts')
    <script src="{{asset('js/admin/dashboard.js')}}"></script>
@endsection

@section('content')
    @php
        $baseURL = url('admin');
    @endphp

    <div class="main-content">
        <div>
            <div id="sidebar" class="sidebar">
                <a id="logo" href="{{$baseURL}}"><img src="{{ asset('img/owl_logo.png') }}" alt="Logo"></a>
            
                <a href="{{ $baseURL . '/' }}" class="{{ Request::is('admin') || Request::is('admin/') || Request::is('admin/hotels')  ? 'sidebar-active' : '' }}">
                    <div></div>
                    <i class="fa fa-home" aria-hidden="true"></i><span>Hotels</span>
                </a>

                <a href="{{ $baseURL . '/locations' }}" class="{{ Request::is('admin/locations') ? 'sidebar-active' : '' }}">
                    <div></div>
                    <i class="fa-solid fa-location-dot"></i>Locations
                </a>

                <a href="{{ $baseURL . '/facilities' }}" class="{{ Request::is('admin/facilities') ? 'sidebar-active' : '' }}">
                    <div></div>
                    <i class="fa-solid fa-screwdriver-wrench"></i>Facilities
                </a>

                <a href="{{ $baseURL . '/payments' }}" class="{{ Request::is('admin/payments') ? 'sidebar-active' : '' }}">
                    <div></div>
                    <i class="fa-solid fa-money-bill-transfer"></i>Payments
                </a>

                <a href="{{ $baseURL . '/paymentdetails' }}" class="{{ Request::is('admin/paymentdetails') ? 'sidebar-active' : '' }}">
                    <div></div>
                    <i class="fa-solid fa-dollar-sign"></i>Payment Details
                </a>
            </div>
        </div>
        <!-- Page Content -->
        <div class="page-content" style="width: 100%;">
            @yield('page-content')
        </div>
    </div>
@endsection