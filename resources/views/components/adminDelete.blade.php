@section('cssStyles')
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

<div class="modal-container" id="delete-modal-container">
    <div id="deleteModal" class="modal" style="height: fit-content;">
        <div class="modal-content">
            <span class="close" onclick="closeModal('deleteModal')">&times;</span>
            <h2>Are you sure you want to delete this item?</h2>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" onclick="confirmDelete()">Confirm Delete</button>
                <button type="button" class="btn btn-dark" onclick="closeModal('deleteModal')">Cancel</button>
            </div>
        </div>
    </div>
</div>