@extends('layouts.main')
@section('title', 'Admin Location Page')

@section('cssStyles')
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('content')

<div class="add">
    <button class="add-b" onclick="openModal('addLocationModal')">+</button>
</div>

@php
$columns = ['id', 'name', 'location_id', 'type', 'description', 'image_link'];
$displayNames = ['ID', 'Name', 'Location ID', 'Type', 'Description', 'Image Link'];
$tableName = "Locations"
@endphp

<x-admintable :columns="$columns" :displayNames="$displayNames"  :rows="$locations" :tableName="$tableName" />

<x-adminForm modalId="addLocationModal" :tableName="$tableName">
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="location_id">Location ID:</label>
            <input type="text" name="location_id" id="location_id">
        </div>
        <div>
        <label for="type">Type:</label>
        <select name="type" id="type" required>
            <option value="" disabled selected>Select Type</option>
            <option value="country">Country</option>
            <option value="region">Region</option>
            <option value="city">City</option>
            <option value="place">Place</option>
        </select>
    </div>
        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" required></textarea>
        </div>
        <div>
            <label for="image_link">Image Link:</label>
            <input type="text" name="image_link" id="image_link">
        </div>
</x-adminForm>

<script>
    function openModal(modalId) {
        document.getElementById('modal-container').style.display = 'flex'; 
    }

    function closeModal(modalId) {
        document.getElementById('modal-container').style.display = 'none'; 
    }

    window.onclick = function(event) {
        const modalContainer = document.getElementById('modal-container');
        if (event.target === modalContainer) {
            closeModal();
        }
    }
</script>
@endsection