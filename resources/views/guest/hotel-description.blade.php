@extends('layouts.main')
@section('title', 'Owltel')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    .hotel-desc-container{
        padding: 20px 40px;
        overflow-y: auto;
    }
    .hotel-desc-title{
        color: #430000;
        margin: 0;
    }
    .hotel-desc-address{
        margin-bottom: 17px;
    }
    .hotel-desc-img-container{
        padding: 0 25px;
    }
    .hotel-desc-review-container{
        padding: 0 25px;
        padding-top: 15px;
        align-items: center;
    }
    .hotel-desc-star-container{
        margin-right: 20px;
    }
    .hotel-desc-star{
        padding-right: 5px;
        font-size: 25px;
    }
    .hotel-desc-review-number{
        text-decoration: underline;
    }
    .hotel-desc-facility-title{
        color: #430000;
        width: 100%;
        border-bottom: 1px solid #a87b7b;
    }
    .hotel-desc-facility-container{
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

    .hotel-desc-grid-container > div {
        /* background-color: rgba(255, 255, 255, 0.8); */
        text-align: left;
        padding: 10px 0;
        font-size: 20px;
    }
    .hotel-desc-grid-container > div > i {
        color: #430000;
    }
    .hotel-desc-about-container{
        padding-top: 20px;
    }
    .hotel-desc-about-title{
        color: #430000;
        width: 100%;
        border-top: 1px solid #a87b7b;
        padding-top: 20px;
    }
    .hotel-desc-guest-star{
        font-size: 15px;
        padding-right: 3px;
    }
    .hotel-desc-guest-review-title-container{
        align-items: center;
    }
    .hotel-desc-guest-review-title{
        font-size: 20px;
        padding-right: 5px;
    }
    .hotel-desc-about{
        font-size: 20px;
    }
    .hotel-desc-guest-review{
        font-size: 20px;
    }
    .gallery {
        display: grid;
        grid-template-columns: repeat(8, 1fr);
        grid-template-rows: repeat(8, 5vw);
        grid-gap: 15px;
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
                    <img class="mySlides" src="{{$img}}" style="width:100%; {{$flag?'':"display:none"}}">
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
                            <img class="demo w3-opacity w3-hover-opacity-off" src="{{$img}}" style="width:100%;cursor:pointer" onclick="currentDiv({{$count}})">
                        </div>
                        @php
                            $count = $count+1;
                        @endphp
                    @endforeach
                </div>
            </div>
        </div>
        {{-- looping ratingnya nanti --}}
        <div class="d-flex hotel-desc-review-container">
            <div class="hotel-desc-star-container">
                <i class="bi bi-star-fill hotel-desc-star text-warning"></i>
                <i class="bi bi-star-fill hotel-desc-star text-warning"></i>
                <i class="bi bi-star-fill hotel-desc-star text-warning"></i>
                <i class="bi bi-star-fill hotel-desc-star text-warning"></i>
                <i class="bi bi-star-fill hotel-desc-star text-secondary"></i>
            </div>

            <div class="hotel-desc-review-number">24 Reviews</div>
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
            {{-- Looping juga --}}
            <div>
                <div class="hotel-desc-guest-review-title-container d-flex">
                    <div class="hotel-desc-guest-review-title">"A Tropical Paradise"</div>
                    <div class="d-flex">
                        <i class="hotel-desc-guest-star bi bi-star-fill text-dark"></i>
                        <i class="hotel-desc-guest-star bi bi-star-fill text-dark"></i>
                        <i class="hotel-desc-guest-star bi bi-star-fill text-dark"></i>
                        <i class="hotel-desc-guest-star bi bi-star-fill text-dark"></i>
                        <i class="hotel-desc-guest-star bi bi-star-fill text-secondary"></i>
                    </div>
                </div>
                <div class="hotel-desc-guest-review">
                    “We had an unforgettable stay at Daun Lebar Villas! The private pool and beautiful garden views made it a perfect getaway. The staff were incredibly friendly and attentive, and the location was peaceful yet close to Ubud. Can't wait to come back!”
                </div>
                <div class="hotel-desc-guest-review">
                    — Jessica, USA
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
      if (n > x.length) {slideIndex = 1}
      if (n < 1) {slideIndex = x.length}
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
      }
      x[slideIndex-1].style.display = "block";
      dots[slideIndex-1].className += " w3-opacity-off";
    }
</script>

@endsection
