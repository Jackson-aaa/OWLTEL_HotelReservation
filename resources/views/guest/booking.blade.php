@extends('layouts.main')
@section('title', 'Owltel')
@section('content')

<style>
    .booking-page-wrapper {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        width: 100%;
        padding: 60px;
    }

    .booking-page {
        width: 100%;
        display: flex;
        justify-content: space-between;
    }

    .booking-payment-container {
        width: 40%;
        padding-right: 30px;
    }

    .booking-detail-container {
        width: 60%;
        padding-left: 50px;
        padding-right: 20px;
    }

    .booking-payment-title {
        font-size: 30px;
        padding-bottom: 20px;
    }

    .booking-select-payment-title {
        font-size: 30px;
        padding-top: 20px;
    }

    .payment-method-options-container {
        list-style-type: none;
        padding: 0;
        margin-bottom: 10px;
    }

    .payment-method-option {
        display: inline-block;
    }

    .payment-method-input[type="checkbox"][id^="cb"] {
        display: none;
    }

    .payment-method-image-container {
        border: 1px solid #ababab;
        border-radius: 5px;
        display: block;
        position: relative;
        cursor: pointer;
        width: 50px;
        height: 30px;
        align-content: center;
    }

    .payment-method-image-container>img {
        width: 30px;
        display: block;
        margin: auto;
        transition-duration: 0.1s;
        transform-origin: 50% 50%;
    }

    :checked+.payment-method-image-container {
        border-color: #430000;
    }

    :checked+.payment-method-image-container img {
        z-index: -1;
        transform: scale(0.9);
    }

    .booking-detail-card {
        width: 100%;
        height: fit-content;
        border-radius: 30px;
        border: 1px solid;
        padding: 30px 50px;
        box-shadow: 1px 1px 8px 8px #e0e0e0;
        border: none;
        background-color: #ffffff;
    }

    .booking-detail-image {
        height: 150px;
    }

    .booking-detail-image>img {
        height: 100%;
        border-radius: 10px;
    }

    .booking-detail-top {
        padding-bottom: 50px;
    }

    .booking-hotel-title {
        padding-left: 10px;
    }

    .booking-hotel-name {
        font-size: 30px;
        font-weight: 500;
    }

    .booking-detail-bottom {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        border-bottom: 1px solid #430000;
        margin-bottom: 10px;
    }

    .booking-detail-bottom-detail-title {
        font-size: 20px;
    }

    .booking-detail-bottom-detail-date {
        font-weight: 250;
    }

    .booking-detail-price {
        display: flex;
        padding-top: 25px;
        justify-content: space-between;
        font-size: 30px;
        font-weight: 300;
    }

    .booking-continue-button {
        display: flex;
        justify-content: center;
        margin-top: 30px;
    }

    .booking-continue-button button {
        background-color: #430000;
        border-radius: 10px;
        color: white;
        padding: 3px 100px;
        font-size: 30px;
        border: none;
    }

    .booking-continue-button button:hover {
        background-color: #621111;
    }

    .booking-page-wrapper i {
        position: absolute;
        top: 30px;
        left: 30px;
        font-size: 24px;
        cursor: pointer;
    }
</style>

{{-- <div class="booking-page"> --}}
    {{-- {{'hotelId= ' . $hotel_id}}
    {{'checkin= ' . $check_in}}
    {{'checkout= ' . $check_out}}
    {{'Userid= ' . Auth::id() }} --}}


    <div class="booking-page-wrapper">
        <i class="fa-solid fa-chevron-left" onclick="window.history.back();"></i>
        <form method="POST" action="{{ route('processBooking') }}" class="booking-page">
            @csrf
            <input type="text" name="check_in" value="{{$check_in}}" hidden>
            <input type="text" name="check_out" value="{{$check_out}}" hidden>
            <input type="text" name="hotel_id" value="{{$hotel->id}}" hidden>
            <div class="booking-payment-container">
                <div class="booking-payment-title">
                    Payment
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" disabled
                        value="{{Auth::user()->name}}">
                </div>
                <label for="phone-number" class="form-label">Phone Number</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">+62</span>
                    <input type="text" name="phone_number" id="phone-number" class="form-control" aria-label="Username"
                        aria-describedby="basic-addon1" disabled value="{{Auth::user()->phone_number}}">
                </div>

                <div class="booking-select-payment-title">
                    Select Payment Option
                </div>

                <div>
                    <ul class="payment-method-options-container">
                        @foreach ($payments as $item)
                            <li class="payment-method-option">
                                <input type="checkbox" class="payment-method-input" id="cb{{ $item->id }}"
                                    name="payment_method" value="{{ $item->id }}" {{ $loop->first ? 'checked' : '' }} />
                                <label class="payment-method-image-container" for="cb{{ $item->id }}">
                                    <img src="{{ $item->icon_link }}" />
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="mb-3">
                    <input type="text" name="card_number" class="form-control" placeholder="Card Number*" required>
                </div>
                <div class="row">
                    <div class="mb-3 col">
                        <input type="text" name="card_month" class="form-control" placeholder="MM*" required>
                    </div>
                    <div class="mb-3 col">
                        <input type="text" name="card_year" class="form-control" placeholder="YY*" required>
                    </div>
                    <div class="mb-3 col">
                        <input type="text" name="card_cvv" class="form-control" placeholder="CVV/CVC*" required>
                    </div>
                </div>
                <div class="mb-3">
                    <input type="text" name="card_name" class="form-control" placeholder="Name on card*" required>
                </div>

            </div>

            <div class="booking-detail-container">
                <div class="booking-detail-card">
                    <div class="booking-detail-top d-flex">
                        <div class="booking-detail-image">
                            <img src="{{json_decode($hotel->image_link)[0]}}" alt="">
                        </div>
                        <div class="booking-hotel-title">
                            <div class="booking-hotel-name">{{$hotel->name}}</div>
                            <div class="booking-hotel-address">{{$hotel->address}}</div>
                        </div>
                    </div>
                    <div class="booking-detail-bottom">
                        <div class="booking-detail-bottom-detail-title">
                            Details
                        </div>
                        <div class="booking-detail-bottom-detail-date">
                            {{date('j', strtotime($check_in))}} {{substr(date('F', strtotime($check_in)), 0, 3)}}
                            {{date('Y', strtotime($check_in))}} - {{date('j', strtotime($check_out))}}
                            {{substr(date('F', strtotime($check_out)), 0, 3)}} {{date('Y', strtotime($check_out))}}
                        </div>
                    </div>
                    @php
                        $earlier = new DateTime($check_in);
                        $later = new DateTime($check_out);

                        $days = $earlier->diff($later)->format("%r%a");
                    @endphp
                    <div>
                        Rp{{number_format($hotel->initial_price)}} x {{$days}} nights
                    </div>
                    <div class="booking-detail-price">
                        <div>Total</div>
                        <div>Rp {{number_format($hotel->initial_price * $days)}}</div>
                    </div>
                </div>
                <div class="booking-continue-button">
                    <button type="submit" class="">CONTINUE</button>
                </div>
            </div>
        </form>
    </div>


    <script>
        $('input[type="checkbox"]').on('change', function () {
            $('input[type="checkbox"]').not(this).prop('checked', false);
        });
    </script>

    @endsection