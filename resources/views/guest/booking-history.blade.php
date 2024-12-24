@extends('layouts.main')
@section('title', 'Owltel')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    .booking-hist-page-container{
        margin: 20px 10px 10px 20px;
        height: 100vh;
    }
    .booking-hist-div{
        margin-top: 30px;
        margin-bottom: 5px;
    }
    .booking-hist-div > h2{
        color: #430000;
    }
    .booking-hist-container{
        height: fit-content; padding: 25px; border-bottom: 1px solid #a87b7b;
    }
    .booking-hist-image{
        width: 270px; border-radius: 10px;
    }
    .booking-hist-hotel-container{
        flex-direction:column; margin-left: 25px;
    }
    .booking-hist-hotel-name{
        color: #430000; font-size: 23px; font-weight:500;
    }
    .booking-hist-calendar-icon{
        padding-right: 5px; color:#430000;
    }
    .booking-hist-status{
        background-color: #430000; border-radius:12px; border:none;
    }
    .booking-hist-detail{
        flex-direction:column; text-align:right
    }
</style>

<div class="booking-hist-page-container w-100">
    <div class="booking-hist-div d-flex w-screen h-screen justify-content-center w-100">
        <h2 class="text-center">Booking History</h2>
    </div>

    <div class="booking-hist-container d-flex justify-content-between w-100">
        <div class="d-flex">
            <div class="justify-content-left">
                <img class="booking-hist-image justify-content-left"
                src="https://cdn-65ec7a61c1ac18290c7482d7.closte.com/wp-content/uploads/2024/06/1-br-pool-villa-1.jpg">
            </div>

             <div class="booking-hist-hotel-container d-flex justify-content-between">
                <div>
                    <div class="booking-hist-hotel-name">Daun Lebar Villas</div>
                    <div>Banjar Jl. Susut No.777</div>
                    <div class="d-flex align-items-center">
                        <i class="booking-hist-calendar-icon bi bi-calendar-heart"></i>
                        <div>12/1/2025 - 14/1/2025</div>
                    </div>
                </div>
                <div>
                    <div class="booking-hist-status btn btn-primary">• Booked</div>
                </div>
             </div>
        </div>

         <div class="booking-hist-detail d-flex justify-content-between">
            <div>
                <div>1/1/2025</div>
                <div>Booked for ABC</div>
            </div>
            <div>
                <h4>Rp 1.120.000</h4>
            </div>
         </div>
    </div>
</div>

@endsection
