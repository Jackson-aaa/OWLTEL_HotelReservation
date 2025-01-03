@extends('admin.layout')
@section('title', 'Admin Location Page')


@section('cssStyles')
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('page-content')
<div class="add">
    <button class="add-b" onclick="openModal('addLocationModal')"><i class="fa-solid fa-plus"></i></button>
</div>

@php
$columns = ['id', 'name', 'location_id', 'type', 'description', 'image_link'];
$displayNames = ['ID', 'Name', 'Location ID', 'Type', 'Description', 'Image Link'];
$tableName = "Locations";
$actionName = "Add Location";
$actionName2 = "Edit Location";
$modalIdContainer = "create-modal-container";
$method = "POST";
$id = "create-form";
$editSlot = "components.forms.editLocationForm";
@endphp

<x-admintable :columns="$columns" :displayNames="$displayNames" :rows="$locations" :tableName="$tableName"
    :editRoute="route('locations.edit', ['id' => '__ID__'])" :updateRoute="route('locations.update', ['id' => '__ID__'])"
    :deleteRoute="route('locations.destroy', ['id' => '__ID__'])" :actionName2="$actionName2"
    :editSlot="$editSlot" />

<x-adminform modalId="addLocationModal" :id="$id" :actionName="$actionName" :actionRoute="route('locations.store')"
    :modalIdContainer="$modalIdContainer" :method="$method">
    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
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
        <label for="location_id">Location ID:</label>
        <select name="location_id" id="location_id" required>
            <option value="" disabled selected>Select Parent Location</option>
            @foreach ($locations_all as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea>
    </div>
    <div>
        <label for="image">Image:</label>
        <input type="file" name="image" id="image" accept="image/*" required>
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
        if (modalId === 'addLocationModal') {
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
                closeModal('addLocationModal');
            } else if (event.target === updateModalContainer) {
                closeModal('editModal');
            }
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const typeSelect = document.getElementById('type');
        // console.log(typeSelect);
        const locationSelect = document.getElementById('location_id');
        const locations = @json($locations_all);

        typeSelect.addEventListener('change', () => {
            const selectedType = typeSelect.value;

            locationSelect.innerHTML = '<option value="" disabled selected>Select Location ID</option>';

            if (!selectedType || selectedType === 'country') {
                locationSelect.disabled = true;
            } else {
                locationSelect.disabled = false;

                let parentType = '';
                if (selectedType === 'region') parentType = 'country';
                if (selectedType === 'city') parentType = 'region';
                if (selectedType === 'place') parentType = 'city';

                const filteredLocations = locations.filter(location => location.type === parentType);

                filteredLocations.forEach(location => {
                    const option = document.createElement('option');
                    option.value = location.id;
                    option.textContent = location.name;
                    locationSelect.appendChild(option);
                });
            }
        });
    });
</script>
@endsection