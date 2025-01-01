@extends('layouts.main')
@section('title', 'Owltel')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    .booking-hist-page-container {
        margin: 20px 10px 10px 20px;
        height: 100vh;
    }

    .booking-hist-div {
        margin-top: 30px;
        margin-bottom: 5px;
    }

    .booking-hist-div>h2 {
        color: #430000;
    }

    .booking-hist-container {
        height: fit-content;
        padding: 25px;
        border-bottom: 1px solid #a87b7b;
    }

    .booking-hist-image {
        width: 270px;
        border-radius: 10px;
    }

    .booking-hist-hotel-container {
        flex-direction: column;
        margin-left: 25px;
    }

    .booking-hist-hotel-name {
        color: #430000;
        font-size: 23px;
        font-weight: 500;
    }

    .booking-hist-calendar-icon {
        padding-right: 5px;
        color: #430000;
    }

    .booking-hist-status {
        background-color: #430000;
        border-radius: 12px;
        border: none;
    }

    .booking-hist-detail {
        flex-direction: column;
        text-align: right
    }

    .pagination-container {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin-top: 20px;
        box-shadow: none !important;
    }

    .pagination {
        box-shadow: none !important;
    }

    .pagination-container nav {
        box-shadow: none;
    }

    .pagination {
        z-index: 10;
    }

    .pagination .page-link {
        padding: 8px 12px;
        font-size: 14px;
        color: #580000;
        border-radius: 8px;
        margin: 0 5px;
        text-decoration: none;
        box-shadow: none !important;
    }

    .pagination .page-item.active .page-link {
        background-color: #580000;
        color: #fff;
        border: none;
    }

    .pagination .page-link.disabled {
        color: #ccc;
        background-color: #f8f9fa;
    }

    .pagination .page-item .page-link {
        padding: 5px 10px;
    }
</style>

<div class="booking-hist-page-container w-100">
    <div class="booking-hist-div d-flex w-screen h-screen justify-content-center w-100">
        <h2 class="text-center">Booking History</h2>
    </div>

    @foreach ($bookings as $booking)
        <div class="booking-hist-container d-flex justify-content-between w-100">
            <div class="d-flex">
                <div class="justify-content-left">
                    <img class="booking-hist-image justify-content-left"
                        src="{{json_decode($booking['hotel_image'])[0]}}">
                </div>

                <div class="booking-hist-hotel-container d-flex justify-content-between">
                    <div>
                        <div class="booking-hist-hotel-name">{{$booking['hotel_name']}}</div>
                        <div>{{$booking['hotel_address']}}</div>
                        <div class="d-flex align-items-center">
                            <i class="booking-hist-calendar-icon bi bi-calendar-heart"></i>
                            <div>{{$booking['check_in']}} - {{$booking['check_out']}}</div>
                        </div>
                    </div>
                    <div>
                        <div class="booking-hist-status btn btn-primary">• {{$booking['status']}}</div>
                    </div>
                </div>
            </div>

            <div class="booking-hist-detail d-flex justify-content-between">
                <div>
                    <div>{{$booking['book_date']}}</div>
                    <div>Booked for {{$booking['booked_for']}}</div>
                </div>
                <div>
                    <h4>{{money((float)$booking['total_price'], 'IDR', true)}}</h4>
                </div>
            </div>
        </div>
    @endforeach
    @if ($bookings instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="pagination-container">
            {{ $bookings->links('vendor.pagination.bootstrap-5') }}
        </div>
    @endif
</div>
@endsection