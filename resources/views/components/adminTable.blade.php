@section('cssStyles')
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@php
$modalIdContainer = "update-modal-container";
$method = "POST";
$id = "edit-form";
@endphp

<div>
    <div class="upper">
        <div class="table-name">
            {{ $tableName }}
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search..." wire:model="searchTerm">
        </div>
    </div>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    @foreach($displayNames as $displayName)
                    <th>{{ $displayName }}</th>
                    @endforeach
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rows as $row)
                <tr>
                    @foreach($columns as $column)
                    <td>{{ $row[$column] ?? 'N/A' }}</td>
                    @endforeach
                    <td>
                        <div class="action">
                            <a href="javascript:void(0);" onclick="openEditModal('{{ $editRoute }}', {{ $row['id'] }})" class="btn-edit">Edit</a>

                            <x-adminform modalId="editModal" :id="$id" :actionName="$actionName2" :actionRoute="str_replace('__ID__', $row['id'], $updateRoute)" :modalIdContainer="$modalIdContainer" :method="$method">
                                @method('PUT')
                                <div>
                                    <label for="name">Name:</label>
                                    <input type="text" name="name" id="edit-name" required>
                                </div>
                                <div>
                                    <label for="location_id">Location ID:</label>
                                    <input type="text" name="location_id" id="edit-location_id">
                                </div>
                                <div>
                                    <label for="type">Type:</label>
                                    <select name="type" id="edit-type" required>
                                        <option value="" disabled>Select Type</option>
                                        <option value="country">Country</option>
                                        <option value="region">Region</option>
                                        <option value="city">City</option>
                                        <option value="place">Place</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="description">Description:</label>
                                    <textarea name="description" id="edit-description" required></textarea>
                                </div>
                                <div>
                                    <label for="image_link">Image Link:</label>
                                    <input type="text" name="image_link" id="edit-image_link">
                                </div>
                                <div class="sub-container">
                                    <button class="sub-button" type="submit">Submit</button>
                                </div>
                            </x-adminform>

                            <form id="deleteForm-{{ $row['id'] }}" action="{{ str_replace('__ID__', $row['id'], $deleteRoute) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')

                                <!-- wtf it says the second argument is error but IT WORKS!
                                    I spent hours figuring this out, IT'S NOT AN ERROR!
                                -->
                                <button type="button" onclick="openModal2('deleteModal', {{ $row['id'] }})" class="btn-delete">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <x-admindelete modalId="deleteModal" />



    @if ($rows instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="pagination-container">
        {{ $rows->links('vendor.pagination.bootstrap-5') }}
    </div>
    @endif

    <script>
        function openEditModal(edit, rowId) {
            const editUrl = edit.replace('__ID__', rowId);

            fetch(editUrl)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit-name').value = data.name;
                    document.getElementById('edit-location_id').value = data.location_id;
                    document.getElementById('edit-type').value = data.type;
                    document.getElementById('edit-description').value = data.description;
                    document.getElementById('edit-image_link').value = data.image_link;

                    document.getElementById('update-modal-container').style.display = 'flex';
                })
                .catch(error => console.error('Error fetching data:', error));
        }


        function confirmDelete() {
            var rowId = document.getElementById('deleteModal').getAttribute('data-row-id');
            if (!rowId) {
                console.error("Row ID is null or undefined");
                return;
            }
            var form = document.getElementById('deleteForm-' + rowId);
            if (form) {
                form.submit();
            } else {
                console.error("Form not found for row ID:", rowId);
            }
        }

        function openModal2(modalId, rowId) {
            document.getElementById('delete-modal-container').style.display = 'flex';
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.setAttribute('data-row-id', rowId);
            } else {
                console.error("Modal not found:", modalId);
            }
        }
    </script>
</div>