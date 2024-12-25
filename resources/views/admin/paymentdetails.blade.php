@extends('admin.layout')
@section('title', 'Admin Payment Details Page')


@section('cssStyles')
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('page-content')
<div class="add">
    <button class="add-b" onclick="openModal('addPaymentDetailModal')"><i class="fa-solid fa-plus"></i></button>
</div>

@php
    $columns = ['payment_name', 'id', 'name', 'description', 'icon_link', 'has_extra_fee'];
    $displayNames = ['Payment Name', 'ID', 'Name', 'Description', 'Icon', 'Extra Fee'];
    $tableName = "Payment Details";
    $actionName = "Add Payment Detail";
    $actionName2 = "Edit Payment Detail";
    $modalIdContainer = "create-modal-container";
    $method = "POST";
    $id = "create-form";
    $editSlot = "components.forms.editPaymentDetailForm";
@endphp

<x-admintable :columns="$columns" :displayNames="$displayNames" :rows="$paymentdetails" :tableName="$tableName"
    :editRoute="route('paymentdetails.edit', ['id' => '__ID__'])" :updateRoute="route('paymentdetails.update', ['id' => '__ID__'])" :deleteRoute="route('paymentdetails.destroy', ['id' => '__ID__'])" :actionName2="$actionName2"
    :editSlot="$editSlot" />

<x-adminform modalId="addPaymentDetailModal" :id="$id" :actionName="$actionName"
    :actionRoute="route('paymentdetails.store')" :modalIdContainer="$modalIdContainer" :method="$method">
    <div>
        <label for="payment">Payment:</label>
        <select name="payment" id="payment" required>
            <option value="" disabled selected>Select Type</option>
            @foreach ($payments as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
    </div>
    <div>
        <label for="description">Description:</label>
        <input type="text" name="description" id="description" required>
    </div>
    <div>
        <label for="image">Icon Image:</label>
        <input type="file" name="image" id="image" accept="image/*" required>
    </div>
    <div class="mt-3">
        <label for="extra_fee">Extra Fee:</label>
        <input type="checkbox" name="extra_fee" id="extra_fee" onchange="showExtraFee(this.checked, false)">
    </div>
    <div class="opacity-25" id="extra_fee_name_container">
        <label class="ms-2 me-1" for="extra_fee_name">Name:</label>
        <input type="text" name="extra_fee_name" id="extra_fee_name" disabled required>
    </div>
    <div class="opacity-25" id="extra_fee_percentage_container">
        <label class="ms-2 me-1" for="extra_fee_percentage">Percentage:</label>
        <input type="number" name="extra_fee_percentage" id="extra_fee_percentage" disabled required>
    </div>
    <div class="sub-container">
        <button class="sub-button" type="submit">Submit</button>
    </div>
</x-adminform>

<script>
    function showExtraFee(isChecked, edit) {
        // console.log(isChecked);

        const nameContainer = document.getElementById(edit ? 'edit-extra_fee_name_container' : 'extra_fee_name_container');
        const percentageContainer = document.getElementById(edit ? 'edit-extra_fee_percentage_container' : 'extra_fee_percentage_container');
        const nameInput = document.getElementById(edit ? 'edit-extra_fee_name' : 'extra_fee_name');
        const percentageInput = document.getElementById(edit ? 'edit-extra_fee_percentage' : 'extra_fee_percentage');

        if(isChecked){
            nameContainer.classList.remove('opacity-25');
            percentageContainer.classList.remove('opacity-25');
            nameInput.disabled = false;
            percentageInput.disabled = false;
        }
        else{
            nameContainer.classList.add('opacity-25');
            percentageContainer.classList.add('opacity-25');
            nameInput.disabled = true;
            percentageInput.disabled = true;
        }
    }

    function openModal(modalId) {
        document.getElementById('create-modal-container').style.display = 'flex';
    }

    function closeModal(modalId) {
        if (modalId === 'addPaymentDetailModal') {
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