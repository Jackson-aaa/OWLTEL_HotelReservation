@extends('layouts.main')
@section('title', 'Owltel')

@section('cssStyles')
<style>
    .dashboard-description{
        color: #430000;
        max-height: 400px;
        max-width: 800px;
    }
    h1.fs-1{
        font-size: 8em!important;
    }
    .text-center{
        size: 100px;
    }


    .carousel-indicators img{
        width: 70px;
        height: 35px;
        display: block;
    }
    .carousel-indicators button{
        width: max-content!important;
    }
    .carousel-indicators{
        position: unset;
    }
    .carousel-indicators button.active img{
        border: 1px solid #430000;
    }
    .carousel-inner{
        height: 450px;
        width: 800px;
    }
    .carousel-inner img{
        height: 450px;
        width: 800px;
        object-fit: fill;
    }
    .carousel-inner button{
        border: none;
        border-radius: 4px;
        padding: 5px 10px 5px 10px;
        background-color: #D9D9D9;
        color: #430000;
    }

    .carousel-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to top, black 0%, transparent 100%);
        opacity: 0.6;
        z-index: 1;
    }

    .carousel-caption {
        z-index: 2;
    }


    .index{
        width: 100%;
        min-height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding-block: 20px;
    }
</style>
@endsection

@section('content')

<div class="index">
<div class="dashboard-description">
    <h1 class="fs-1 text-center fw-bold">OWLTEL</h1>
    <p class="text-center">
    Discover your perfect getaway with our user-friendly hotel search platform!
    Whether you’re planning a weekend getaway or a month-long adventure, we make it simple to find the ideal accommodation that suits your needs and budget.
    </p>
</div>
    <div class="carousel slide" id="carouselDemo" data-bs-wrap="true" data-bs-ride="carousel" >
        <div class="carousel-inner">
            @foreach($destinations as $index => $destination)
            <div class="carousel-item {{$index === 0 ? 'active' : ''}}">
                <img src="{{$destination->image_link}}" class="d-block w-100">
                <div class="carousel-caption">
                    <h5>{{$destination->name}}</h5>
                    <p>{{$destination->description}}</p>
                    <button>Show All</button>
                </div>
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselDemo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselDemo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Previous</span>
        </button>
    </div>
<div class="carousel-indicators">
    @foreach($destinations as $index => $destination)
        <button type="button" class="{{$index === 0 ? 'active' : ''}}" data-bs-target="#carouselDemo" data-bs-slide-to="{{$index}}">
            <img src="{{$destination->image_link}}" alt="">
        </button>
    @endforeach
</div>

<script>
    document.getElementById('carouselDemo').addEventListener('slid.bs.carousel', function(event){
        var buttons = document.querySelectorAll('.carousel-indicators button');
        buttons.forEach(function(button) {
            button.classList.remove('active');
        });
        buttons[event.to].classList.add('active');
    });
</script>
</div>
@endsection
