@extends('admin.layout')
@section('title', 'Admin Facility Page')


@section('cssStyles')
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('page-content')
<div class="add">
    <button class="add-b" onclick="openModal('addFacilityModal')"><i class="fa-solid fa-plus"></i></button>
</div>

@php
    $columns = ['id', 'name', 'icon_link'];
    $displayNames = ['ID', 'Name', 'Icon'];
    $tableName = "Facilities";
    $actionName = "Add Facility";
    $actionName2 = "Edit Facility";
    $modalIdContainer = "create-modal-container";
    $method = "POST";
    $id = "create-form";
@endphp

<x-admintable :columns="$columns" :displayNames="$displayNames" :rows="$facilities" :tableName="$tableName"
    :editRoute="route('facilities.edit', ['id' => '__ID__'])" :updateRoute="route('facilities.update', ['id' => '__ID__'])"
    :deleteRoute="route('facilities.destroy', ['id' => '__ID__'])" :actionName2="$actionName2" />

<x-adminform modalId="addFacilityModal" :id="$id" :actionName="$actionName" :actionRoute="route('facilities.store')"
    :modalIdContainer="$modalIdContainer" :method="$method">
    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
    </div>
    <div>
        <label for="icon_link">Icon:</label>
        <input type="text" name="icon_link" id="icon_link" value="" required>
    </div>
    <div class="sub-container">
        <button class="sub-button" type="submit">Submit</button>
    </div>
</x-adminform>

<script>
    document.addEventListener('DOMContentLoaded', function(event) {
        const uip = new UniversalIconPicker('#icon_link', {
            iconLibraries: [
                'font-awesome-regular.min.json',
                'font-awesome-solid.min.json',
                'font-awesome-brands.min.json',
                'material-icons-filled.min.json',
                'material-icons-outlined.min.json',
                'material-icons-round.min.json',
                'material-icons-sharp.min.json',
                'material-icons-two-tone.min.json',
            ],
            iconLibrariesCss: [],
            resetSelector: '',
            onSelect: function(jsonIconData) {
                console.log(jsonIconData);
                document.getElementById('icon_link').value = jsonIconData.iconHtml;
            },
            onReset: function() {
                document.getElementById('icon_link').value = '';
            }
        });
    });


    function openModal(modalId) {
        document.getElementById('create-modal-container').style.display = 'flex';
    }

    function closeModal(modalId) {
        if (modalId === 'addFacilityModal') {
            document.getElementById('create-modal-container').style.display = 'none';
        } else if (modalId === 'deleteModal') {
            document.getElementById('delete-modal-container').style.display = 'none';
        } else if (modalId === 'editModal') {
            document.getElementById('update-modal-container').style.display = 'none';
        }
    }

    window.onclick = function (event) {
        window.onclick = function (event) {
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
</script>
@endsection