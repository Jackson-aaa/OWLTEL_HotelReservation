@extends('layouts.main')
@section('title', 'Owltel')
@section('content')

<div>
    {{'hotelId= ' . $hotel_id}}
    {{'checkin= ' . $check_in}}
    {{'checkout= ' . $check_out}}
    {{'Userid= ' . Auth::id() }}
</div>

@endsection