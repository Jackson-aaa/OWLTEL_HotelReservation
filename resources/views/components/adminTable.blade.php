@section('cssStyles')
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

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
                                <button wire:click="editLocation({{ $row['id'] }})" class="btn-edit">Edit</button>
                                <button class="btn-delete">Delete</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <x-adminForm modalId="editLocationModal" :actionName="'Edit Location'" :actionRoute="route('locations.update', $selectedLocation->id ?? '')" method="PUT">
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ $selectedLocation->name ?? '' }}" required>
        </div>
        <div>
            <label for="location_id">Location ID:</label>
            <input type="text" name="location_id" id="location_id" value="{{ $selectedLocation->location_id ?? '' }}">
        </div>
        <div>
            <label for="type">Type:</label>
            <select name="type" id="type" required>
                <option value="" disabled>Select Type</option>
                <option value="country" {{ isset($selectedLocation) && $selectedLocation->type === 'country' ? 'selected' : '' }}>Country</option>
                <option value="region" {{ isset($selectedLocation) && $selectedLocation->type === 'region' ? 'selected' : '' }}>Region</option>
                <option value="city" {{ isset($selectedLocation) && $selectedLocation->type === 'city' ? 'selected' : '' }}>City</option>
                <option value="place" {{ isset($selectedLocation) && $selectedLocation->type === 'place' ? 'selected' : '' }}>Place</option>
            </select>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" required>{{ $selectedLocation->description ?? '' }}</textarea>
        </div>
        <div>
            <label for="image_link">Image Link:</label>
            <input type="text" name="image_link" id="image_link" value="{{ $selectedLocation->image_link ?? '' }}">
        </div>
        <div class="sub-container">
            <button class="sub-button" type="submit">Update</button>
        </div>
    </x-adminForm>
    
    @if ($rows instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="pagination-container">
            {{ $rows->links('vendor.pagination.bootstrap-5') }}
        </div>
    @endif

    <script>
        window.addEventListener('openModal', event => {
            document.getElementById(event.detail.modalId).style.display = 'flex'; 
        });

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none'; 
        }

        window.onclick = function(event) {
            const modalContainer = document.getElementById('modal-container');
            if (event.target === modalContainer) {
                closeModal('editLocationModal');
            }
        }
    </script>
</div>



