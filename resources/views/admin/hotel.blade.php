@extends('admin.layout')
@section('title', 'Admin Hotel Page')

@section('cssStyles')
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('page-content')
<style>
    .facilityContainer{
        flex-wrap: wrap;
    }
    .facilities input{
        width: 17px;
        height: 17px;
    }
    .facility_name{
        padding: 5px;
    }
</style>
<div class="add">
    <button class="add-b" onclick="openModal('addHotelModal')"><i class="fa-solid fa-plus"></i></button>
</div>

@php
$columns = ['id', 'name', 'description', 'address', 'initial_price', 'image_link'];
$displayNames = ['ID', 'Name', 'Description', 'Address', 'Initial Price', 'Image Link(s)'];
$tableName = "Hotels";
$actionName = "Add Hotel";
$actionName2 = "Edit Hotel";
$modalIdContainer = "create-modal-container";
$method = "POST";
$id = "create-form";
$editSlot = "components.forms.editHotelForm";

@endphp

<x-admintable
    :columns="$columns"
    :displayNames="$displayNames"
    :rows="$hotels"
    :tableName="$tableName"
    :editRoute="route('hotels.edit', ['id' => '__ID__'])"
    :updateRoute="route('hotels.update', ['id' => '__ID__'])"
    :deleteRoute="route('hotels.destroy', ['id' => '__ID__'])"
    :actionName2="$actionName2"
    :editSlot="$editSlot" />

<x-adminform modalId="addHotelModal" :id="$id" :actionName="$actionName" :actionRoute="route('hotels.store')" :modalIdContainer="$modalIdContainer" :method="$method">
    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
    </div>
    <div>
        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea>
    </div>
    <div>
        <label for="address">Address:</label>
        <textarea name="address" id="address" required></textarea>
    </div>
    <div>
        <label for="location_id">Location ID:</label>
        <select name="location_id" id="location_id" required>
            <option value="" disabled selected>Select Location ID</option>
            @foreach ($locations as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="images">Images:</label>
        <input type="file" name="images[]" id="images" accept="image/*" multiple required>
    </div>
    <div>
        <label for="initial_price">Initial Price:</label>
        <input type="text" name="initial_price" id="initial_price">
    </div>
    <div>
        <label>Facilities:</label>
        <div class="facilityContainer">
        @foreach ($facilities as $facility)
            <div class="facilities">
                <input type="checkbox" name="facilities[]" value="{{ $facility->id }}" id="facility_{{ $facility->id }}">
                <label for="facility_{{ $facility->id }}" class="facility_name">{{ $facility->name }}</label>
            </div>
        @endforeach
        </div>
    </div>
    <div class="sub-container">
        <button class="sub-button" type="submit">Submit</button>
    </div>
</x-adminform>

<script>
    function openModal(modalId) {
        // console.log(modalId)
        document.getElementById('create-modal-container').style.display = 'flex';
    }

    function closeModal(modalId) {
        if (modalId === 'addHotelModal') {
            document.getElementById('create-modal-container').style.display = 'none';
        } else if (modalId === 'deleteModal') {
            document.getElementById('delete-modal-container').style.display = 'none';
        } else if (modalId === 'editModal') {
            document.getElementById('update-modal-container').style.display = 'none';
        }
    }

    window.onclick = function(event) {
        window.onclick = function(event) {
            const deleteModalContainer = document.getElementById('delete-modal-container');
            const createModalContainer = document.getElementById('create-modal-container');
            const updateModalContainer = document.getElementById('update-modal-container');
            if (event.target === deleteModalContainer) {
                closeModal('deleteModal');
            } else if (event.target === createModalContainer) {
                closeModal('addHotelModal');
            } else if (event.target === updateModalContainer) {
                closeModal('editModal');
            }
        }
    }
</script>
@endsection