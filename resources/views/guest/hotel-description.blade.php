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
    .hotel-desc-left-img{
        width: calc(50% - 5px);
        margin-right: 10px;
    }
    .hotel-desc-right-img{
        width: calc(50% - 5px);
    }
    .hotel-desc-sub-right-img{
        width: calc(50% - 5px);
    }
    .hotel-desc-sub-left-img{
        width: calc(50% - 5px);
        margin-right: 10px;
    }

    .hotel-desc-sub-top-img{
        margin-bottom: 10px;
        height: calc(50% - 5px);
        width: 100%;
    }
    .hotel-desc-sub-bot-img{
        height: calc(50% - 5px);
        width: 100%;
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
</style>

<div class="hotel-desc-container w-100 h-100">
    <div>
        <h1 class="hotel-desc-title">Daun Lebar Villas</h1>
        <div class="hotel-desc-address">Banjar Jl. Susut No.777</div>
        <div class="hotel-desc-img-container d-flex w-100">
            <div class="hotel-desc-left-img">
                <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/14/1a/9b/8f/getlstd-property-photo.jpg?w=700&h=-1&s=1" class="w-100 h-100">
            </div>
            <div class="hotel-desc-right-img d-flex">
                <div class="hotel-desc-sub-left-img">
                    <div class="hotel-desc-sub-top-img">
                        <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/168374097.jpg?k=211b8433e9e5ebdebef2cc37d4e1a022ebd7d099801e41e8bfae2051e33a587a&o=&hp=1" class="w-100">
                    </div>
                    <div class="hotel-desc-sub-bot-img">
                        <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/168374105.jpg?k=a8439f9b7351f208e42ce84f63e5500bb4338bc491d1d21a2ab4f893b9b91b5b&o=&hp=1" class="w-100">
                    </div>
                </div>
                <div class="hotel-desc-sub-right-img">
                    <div class="hotel-desc-sub-top-img">
                        <img src="https://daun-lebar-villas-bali.hotelmix.id/data/Photos/OriginalPhoto/7836/783667/783667212/Daun-Lebar-Villas-Payangan-Exterior.JPEG" class="w-100">
                    </div>
                    <div class="hotel-desc-sub-bot-img">
                        <img src="https://images.trvl-media.com/lodging/27000000/26820000/26814800/26814764/2932cd49.jpg?impolicy=resizecrop&rw=575&rh=575&ra=fill" class="w-100">
                    </div>
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
            {{-- nanti di loop icon and text --}}
            <div class=""><i class="bi bi-tv"></i> TV</div>
            <div class=""><i class="bi bi-wifi"></i> WiFi</div>
            <div class=""><i class="bi bi-p-circle"></i> Parking</div>
            <div class="">AC</div>
        </div>
    </div>

    <div class="hotel-desc-about-container">
        <div class="hotel-desc-about-title">
            <h3>About This Place</h3>
        </div>
        <div class="hotel-desc-about">
            Daun Lebar Villas reconnects you with nature through a unique stay in the heart of Ubud's countryside. This 4-star resort offers spacious villas with a distinctive Balinese atmosphere and outdoor swimming pools. Free WiFi is available throughout the resort during your stay.
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

@endsection
