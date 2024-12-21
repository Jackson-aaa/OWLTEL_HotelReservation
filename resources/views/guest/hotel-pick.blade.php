@extends('layouts.main')
@section('title', 'Owltel')

@section('content')
<style>
  .list{
    padding: 20px;
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
  }
</style>
<div class="list">
  @foreach($hotels as $hotel)
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="{{$hotel->image_link}}" class="img-fluid rounded-start" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">{{$hotel->name}}</h5>
              <p class="card-text">{{$hotel->address}}</p>
              <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
            </div>
          </div>
        </div>
    </div>
  @endforeach
</div>

@endsection
