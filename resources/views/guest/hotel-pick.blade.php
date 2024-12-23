@extends('layouts.main')
@section('title', 'Owltel')

@section('content')
<style>
  .list{
    padding: 20px;
    width: 100%;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    overflow:scroll;
    overflow-x: hidden;
  }
  .icon{
    color: #580000;
    display: inline-block;
    padding: 0px 10px 0px 10px;
  }
  .container-icon{ /* biar iconnya positionnya simetris */
    display: flex;
    height: 100%;
    margin: 0px;
    padding: 0px;
  }
  p{
    margin: 0;
    padding: 0;
  }
  hr{
    margin: 0px;
    padding: 5px 0px 5px 0px;
  }
  .price{
    display: flex;
    justify-content: flex-end;
    font-size: 20px;
  }
  .images{
    width: 320px;
    height: 220px;
    object-fit: cover;
    border-radius: 4px;
  }
  .card-body{
    min-height: 100%;
    max-height: 220px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }
  .mb-3{
    margin-bottom: 3rem!important;
  }
</style>

<div class="list">
  @foreach($hotels as $hotel)
    <div class="card mb-3" style="max-width: 680px;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="{{$hotel->image_link}}" class="img-fluid rounded-start images" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title" style="font-size: 24px; color:#580000; margin:0px;">{{$hotel->name}}</h5>
              <p class="card-text" style="font-size: 15px; padding:0px 0px 20px 0px">{{$hotel->address}}</p>
              <p class="text" style="font-size: 22px; letter-spacing: 2px">Amenities</p>
              <hr>
              <div class="container-icon">
                @foreach($hotel->facilities as $facility)
                  <div class="icon">{!! $facility->icon_link !!}</div>
                @endforeach
              </div>
              <hr>
              <p class="card-text"><small class="text-body-secondary price">{{money($hotel->initial_price, 'IDR')}}</small></p>
            </div>
          </div>
        </div>
    </div>
  @endforeach
</div>

@endsection
