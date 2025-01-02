@extends('layouts.main')
@section('title', 'Owltel')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    .hotel-desc-container {
        padding: 20px 40px;
        overflow-y: auto;
    }

    .hotel-desc-title {
        color: #430000;
        margin: 0;
    }

    .hotel-desc-address {
        margin-bottom: 17px;
    }

    .hotel-desc-img-container {
        padding: 0 25px;
    }

    .hotel-desc-review-container {
        padding: 0 25px;
        padding-top: 15px;
        align-items: center;
    }

    .hotel-desc-star-container {
        margin-right: 20px;
    }

    .hotel-desc-star {
        padding-right: 5px;
        font-size: 25px;
    }

    .hotel-desc-review-number {
        text-decoration: underline;
    }

    .hotel-desc-facility-title {
        color: #430000;
        width: 100%;
        border-bottom: 1px solid #a87b7b;
    }

    .hotel-desc-facility-container {
        padding-top: 25px;
    }

    .hotel-desc-grid-container {
        display: grid;
        grid-template-columns: auto auto auto;
        grid-template-rows: auto auto;
        grid-gap: 10px;
        /* background-color: #2196F3; */
        padding: 10px;
        height: fit-content;
    }

    .hotel-desc-grid-container>div {
        /* background-color: rgba(255, 255, 255, 0.8); */
        text-align: left;
        padding: 10px 0;
        font-size: 20px;
    }

    .hotel-desc-grid-container>div>i {
        color: #430000;
    }

    .hotel-desc-about-container {
        padding-top: 20px;
    }

    .hotel-desc-about-title {
        color: #430000;
        width: 100%;
        border-top: 1px solid #a87b7b;
        padding-top: 20px;
    }

    .hotel-desc-guest-star {
        font-size: 15px;
        padding-right: 3px;
    }

    .hotel-desc-guest-review-title-container {
        align-items: center;
    }

    .hotel-desc-guest-review-title {
        font-size: 20px;
        padding-right: 5px;
    }

    .hotel-desc-about {
        font-size: 20px;
    }

    .hotel-desc-guest-review {
        font-size: 20px;
    }

    .gallery {
        display: grid;
        grid-template-columns: repeat(8, 1fr);
        grid-template-rows: repeat(8, 5vw);
        grid-gap: 15px;
    }


    .book-btn {
        position: fixed;
        bottom: 1%;
        right: 1%;
        z-index: 1000;
        width: 60px;
        height: 60px;
        font-size: 15px;
        background: #430000;
        border: none;
        color: white;
    }

    .book-btn:hover {
        background: #430000;
        opacity: 80%;
        transition: 0.3s;
        color: white;
    }

    .modal-book-btn {
        background: #430000;
        border: none;
        color: white;
        padding-inline: 25px;
        padding-block: 5px;
    }

    .modal-book-btn:hover {
        background: #430000;
        opacity: 80%;
        transition: 0.3s;
        color: white;
    }

    .modal-body-date-container {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: fit-content;
    }

    .modal-body-date-divider {
        height: 50px;
        background-color: black;
        width: 1px;
        margin-block: 5px;
        opacity: 50%;
    }

    .modal-body-date {
        width: 50%;
        text-align: center;
        padding-block: 10px;
    }

    .modal-body-date p {
        margin: 0;
    }

    .modal-body-date hr {
        background-color: black;
        opacity: 50%;
        margin-inline: 20px;
        margin-block: 0;
    }

    .modal-body-date-title {
        font-weight: 200;
    }

    .modal-body-detail-container {
        padding-inline: 20px;
        margin-block: 20px;
    }

    .modal-body-detail-container p,
    .modal-body-detail-container hr {
        margin-block: 0;
    }

    .modal-body-detail-container-total {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        margin-top: 20px;
    }

    .modal-body-detail-container-total p {
        font-size: 18px;
    }
</style>

<div class="hotel-desc-container w-100 h-100">
    <div>
        <h1 class="hotel-desc-title">{{$hotel->name}}</h1>
        <div class="hotel-desc-address">{{$hotel->address}}</div>
        <div class="hotel-desc-img-container d-flex w-100">
            <div class="w3-content" style="max-width:1200px">
                @php
                    $flag = true;
                @endphp
                @foreach (json_decode($hotel->image_link) as $img)
                                <img class="mySlides" src="{{$img}}" style="width:100%; {{$flag ? '' : "display:none"}}">
                                @php
                                    $flag = false;
                                @endphp
                @endforeach

                <div class="w3-row-padding w3-section">
                    @php
                        $count = 1;
                    @endphp
                    @foreach (json_decode($hotel->image_link) as $img)
                                        <div class="w3-col s4">
                                            <img class="demo w3-opacity w3-hover-opacity-off" src="{{$img}}"
                                                style="width:100%;cursor:pointer" onclick="currentDiv({{$count}})">
                                        </div>
                                        @php
                                            $count = $count + 1;
                                        @endphp
                    @endforeach
                </div>
            </div>
        </div>
        {{-- looping ratingnya nanti --}}
        @php
            $rating = $hotel->bookings
                ->flatMap(fn($booking) => $booking->review ? [$booking->review->score] : [])
                ->avg();
        @endphp
        <div class="d-flex hotel-desc-review-container">
            <div class="hotel-desc-star-container">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $rating)
                        <i class="bi bi-star-fill hotel-desc-star text-warning"></i>
                    @else
                        <i class="bi bi-star-fill hotel-desc-star text-secondary"></i>
                    @endif
                @endfor
            </div>

            <div class="hotel-desc-review-number">
                @php
                    $reviewCount = $hotel->bookings->filter(fn($booking) => $booking->review !== null)->count();
                @endphp

                @if ($reviewCount === 0)
                    No reviews
                @elseif ($reviewCount === 1)
                    1 review
                @else
                    {{ $reviewCount }} reviews
                @endif
            </div>
        </div>
    </div>

    <div class="hotel-desc-facility-container">
        <div class="hotel-desc-facility-title">
            <h3>Facility</h3>
        </div>
        <div class="hotel-desc-grid-container" style="grid-auto-flow: row;">
            @foreach ($hotel->hotelFacilities as $f)
                <div class="">{!!$f->facility->icon_link!!} {{$f->facility->name}}</div>
            @endforeach
        </div>
    </div>

    <div class="hotel-desc-about-container">
        <div class="hotel-desc-about-title">
            <h3>About This Place</h3>
        </div>
        <div class="hotel-desc-about">
            {!!$hotel->description!!}
        </div>
    </div>

    <div class="hotel-desc-about-container">
        <div class="hotel-desc-about-title">
            <h3>Guest Reviews</h3>
        </div>
        <div>
            @php
                $bookings = $hotel->bookings->take(5);
            @endphp

            @if ($bookings->isEmpty() || $bookings->every(fn($booking) => $booking->review === null))
                <div class="hotel-desc-guest-review">
                    No reviews yet. Be the first to share your experience!
                </div>
            @else
                @foreach ($bookings as $booking)
                    @if ($booking->review)
                        <div>
                            <div class="hotel-desc-guest-review">
                                “{{ $booking->review->description }}”
                            </div>
                            <div class="hotel-desc-guest-review">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $booking->review->score)
                                        <i class="hotel-desc-guest-star bi bi-star-fill text-dark"></i>
                                    @else
                                        <i class="hotel-desc-guest-star bi bi-star-fill text-secondary"></i>
                                    @endif
                                @endfor
                                — {{ $booking->user->name }}
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</div>

<button type="button" class="btn book-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Book Now
</button>

@php
    use Carbon\Carbon;
    $checkInDate = Carbon::createFromFormat('d-m-Y', request('check_in'));
    $checkOutDate = Carbon::createFromFormat('d-m-Y', request('check_out'));

    $days = $checkInDate->diffInDays($checkOutDate);
@endphp

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-body-date-container">
                    <div class="modal-body-date">
                        <p class="modal-body-date-title">CHECK IN</p>
                        <hr />
                        <p>{{$checkInDate->format('d-m-Y')}}</p>
                    </div>
                    <div class="modal-body-date-divider"></div>
                    <div class="modal-body-date">
                        <p class="modal-body-date-title">CHECK OUT</p>
                        <hr />
                        <p>{{$checkOutDate->format('d-m-Y')}}</p>
                    </div>
                </div>
                <div class="modal-body-detail-container">
                    <p>Details</p>
                    <hr />
                    <p>{{money((float) $hotel->initial_price, 'IDR', true)}} x {{ $days }}
                        night{{ $days > 1 ? 's' : '' }}</p>
                    <div class="modal-body-detail-container-total">
                        <p>Total</p>
                        <p>{{money((float) $hotel->initial_price * (float) $days, 'IDR', true)}}</p>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <form method="GET" action="{{ route('booking') }}">
                        @csrf
                        <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                        <input type="hidden" name="check_in" value="{{ $checkInDate->format('Y-m-d') }}">
                        <input type="hidden" name="check_out" value="{{ $checkOutDate->format('Y-m-d') }}">
                        <button type="submit" class="btn modal-book-btn">Book</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function currentDiv(n) {
        showDivs(slideIndex = n);
    }

    function showDivs(n) {
        var i;
        var x = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demo");
        if (n > x.length) { slideIndex = 1 }
        if (n < 1) { slideIndex = x.length }
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
        }
        x[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " w3-opacity-off";
    }
</script>

@endsection