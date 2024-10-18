@extends('layouts.main')
@section('title', 'Admin Location Page')

@section('cssStyles')
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('content')

@php
$columns = ['id', 'name', 'location_id', 'type', 'description', 'image_link'];
$displayNames = ['ID', 'Name', 'Location ID', 'Type', 'Description', 'Image Link'];
$tableName = "Locations"
@endphp

<x-admintable :columns="$columns" :displayNames="$displayNames"  :rows="$locations" :tableName="$tableName" />
@endsection