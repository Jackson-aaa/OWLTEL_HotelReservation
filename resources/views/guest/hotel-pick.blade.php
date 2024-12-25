@extends('layouts.main')
@section('title', 'Owltel')

@section('content')
<style>
  .hotel-pick-container {
    display: flex;
    justify-content: center;
    align-items: start;
    height: fit-content;
    width: 100%;
    min-height: fit-content;
  }

  .list {
    padding: 20px;
    width: 50%;
    height: fit-content;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    gap: 30px;
  }

  .icon {
    color: #580000;
    display: inline-block;
    padding: 0px 10px 0px 10px;
  }

  .container-icon {
    /* biar iconnya positionnya simetris */
    display: flex;
    height: 100%;
    margin: 0px;
    padding: 0px;
  }

  p {
    margin: 0;
    padding: 0;
  }

  hr {
    margin: 0px;
    padding: 5px 0px 5px 0px;
  }

  .price {
    display: flex;
    justify-content: flex-end;
    font-size: 20px;
  }

  .images {
    width: 320px;
    height: 220px;
    object-fit: cover;
    border-radius: 4px;
  }

  .card {
    width: 100%;
    cursor: pointer;
  }

  .card:hover {
    box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1);
  }

  .card-body {
    min-height: 100%;
    max-height: max-content;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .mb-3 {
    margin-bottom: 3rem !important;
  }

  .pagination-container {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin-top: 20px;
    box-shadow: none !important;
    width: 100%;
    padding-inline: 20px;
    padding-bottom: 20px;
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

  .map-container {
    width: 40%;
    background-color: #ccc;
    position: sticky;
    height: calc(100vh - 100px);
    top: 20px;
    margin: 20px;
    border-radius: 10px
  }
</style>

<div class="hotel-pick-container">
  <div class="list" onclick="">
    @foreach($hotels as $hotel)
    <div class="card" style="max-width: 680px;" onclick="redirectToHotelDescription({{$hotel['id']}})">
      <div class="row g-0">
      <div class="col-md-4 h-auto mw-100">
        <img src="{{$hotel['image']}}" class="img-fluid rounded-start images" alt="...">
      </div>
      <div class="col-md-8">
        <div class="card-body">
        <h5 class="card-title" style="font-size: 24px; color:#580000; margin:0px;">{{$hotel['name']}}</h5>
        <p class="card-text" style="font-size: 15px; padding:0px 0px 20px 0px">{{$hotel['address']}}</p>
        <p class="text" style="font-size: 22px; letter-spacing: 2px">Amenities</p>
        <hr>
        <div class="container-icon">
          @foreach($hotel['facilities'] as $facility)
            <div class="icon">{!! $facility !!}</div>
          @endforeach
        </div>
        <hr>
        <p class="card-text"><small class="text-body-secondary price">{{money($hotel['price'], 'IDR')}}</small></p>
        </div>
      </div>
      </div>
    </div>
  @endforeach
  </div>
  <div class="map-container">
    The Map
  </div>
</div>
@if ($hotels instanceof \Illuminate\Pagination\LengthAwarePaginator)
  <div class="pagination-container">
    {{ $hotels->links('vendor.pagination.bootstrap-5') }}
  </div>
@endif

<script>
  function redirectToHotelDescription(id) {
    const url = `{{ route('hoteldescription', ':id') }}`.replace(':id', id);
    window.location.href = url;
  }
</script>

@endsection