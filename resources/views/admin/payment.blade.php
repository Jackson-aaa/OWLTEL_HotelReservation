@extends('admin.layout')
@section('title', 'Admin Payment Page')


@section('cssStyles')
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('page-content')
<div class="add">
    <button class="add-b" onclick="openModal('addPaymentModal')"><i class="fa-solid fa-plus"></i></button>
</div>

@php
    $columns = ['id', 'name'];
    $displayNames = ['ID', 'Name'];
    $tableName = "Payments";
    $actionName = "Add Payment";
    $actionName2 = "Edit Payment";
    $modalIdContainer = "create-modal-container";
    $method = "POST";
    $id = "create-form";
    $editSlot = "components.forms.editPaymentForm";
@endphp

<x-admintable :columns="$columns" :displayNames="$displayNames" :rows="$payments" :tableName="$tableName"
    :editRoute="route('payments.edit', ['id' => '__ID__'])" :updateRoute="route('payments.update', ['id' => '__ID__'])" :deleteRoute="route('payments.destroy', ['id' => '__ID__'])" :actionName2="$actionName2"
    :editSlot="$editSlot" />

<x-adminform modalId="addPaymentModal" :id="$id" :actionName="$actionName" :actionRoute="route('payments.store')"
    :modalIdContainer="$modalIdContainer" :method="$method">
    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
    </div>
    <div class="sub-container">
        <button class="sub-button" type="submit">Submit</button>
    </div>
</x-adminform>

<script>
    function openModal(modalId) {
        document.getElementById('create-modal-container').style.display = 'flex';
    }

    function closeModal(modalId) {
        if (modalId === 'addPaymentModal') {
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