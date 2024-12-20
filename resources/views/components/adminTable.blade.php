@section('cssStyles')
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@php
$modalIdContainer = "update-modal-container";
$method = "POST";
$id = "edit-form";
$actionRoute = "";
@endphp

<div class="table-wrapper">
    <div class="upper mb-3">
        <div class="table-name">
            {{ $tableName }}
        </div>
        <form class="d-flex" role="search" method="GET"
            action="{{ route(strtolower(str_replace(' ', '', $tableName)) . '.index') }}">
            <input class="form-control input-font-size-xs" name="search" type="search" placeholder="Search"
                aria-label="Search">
            <button class="btn btn-sm fs-6" type="submit"><i class="fas fa-search"></i></button>
        </form>
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
                    <td>
                        @if($column === 'image_link' || $column === 'icon_link')
                        @if($column === 'icon_link')
                        <span>{!! $row[$column] ?? 'N/A' !!}</span>
                        @else
                        @php
                        $imageLinks = json_decode($row[$column], true);
                        @endphp

                        @if(is_array($imageLinks))
                        @foreach($imageLinks as $imageLink)
                        <a href="{{ $imageLink }}" target="_blank">{{ $imageLink }}</a><br>
                        @endforeach
                        @else
                        <a href="{{ $row[$column] ?? '#' }}" target="_blank">{{ $row[$column] ?? 'N/A' }}</a>
                        @endif
                        @endif
                        @else
                        {{ $row[$column] ?? 'N/A' }}
                        @endif
                    </td>
                    @endforeach
                    <td>
                        <div class="action">
                            <a href="javascript:void(0);"
                                onclick="openEditModal('{{ $editRoute }}', '{{ $updateRoute }}', {{ $row['id'] }})"
                                class="btn-edit">Edit</a>

                            <x-adminform modalId="editModal" :id="$id" :actionName="$actionName2"
                                :modalIdContainer="$modalIdContainer" :method="$method" :actionRoute="$actionRoute">
                                @method('PUT')
                                @include($editSlot)
                            </x-adminform>

                            <form id="deleteForm-{{ $row['id'] }}"
                                action="{{ str_replace('__ID__', $row['id'], $deleteRoute) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')

                                <!-- wtf it says the second argument is error but IT WORKS!
                                            I spent hours figuring this out, IT'S NOT AN ERROR!
                                        -->
                                <button type="button" onclick="openModal2('deleteModal', {{ $row['id'] }})"
                                    class="btn-delete">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if ($rows instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="pagination-container">
        {{ $rows->links('vendor.pagination.bootstrap-5') }}
    </div>
    @endif


    <x-admindelete modalId="deleteModal" />

    <script>
        function openEditModal(edit, update, rowId) {
            const editUrl = edit.replace('__ID__', rowId);
            const updateUrl = update.replace('__ID__', rowId);

            fetch(editUrl)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    const form = document.getElementById('edit-form');

                    form.querySelectorAll('input, select, textarea').forEach(input => {
                        const fieldName = input.name || input.id;

                        if (data.hasOwnProperty(fieldName)) {
                            if (input.tagName === 'INPUT') {
                                if (input.type === 'checkbox') {
                                    input.checked = Boolean(data[fieldName]);
                                    showExtraFee(input.checked, true);
                                } else {
                                    input.value = data[fieldName];
                                }
                            } else if (input.tagName === 'SELECT') {
                                input.value = data[fieldName];
                            } else if (input.tagName === 'TEXTAREA') {
                                input.value = data[fieldName];
                            }
                        }
                    });

                    if (data.hasOwnProperty('image_link')) {
                        const imagePreview = document.getElementById('image-preview');
                        const imageLink = data['image_link'];
                        let imgs;

                        try {
                            // Try to parse image_link as a JSON array
                            imgs = JSON.parse(imageLink);

                            // If it's an array, display the first image (you can modify this to show all images or handle them differently)
                            if (Array.isArray(imgs)) {
                                imagePreview.src = imgs[0]; // Display the first image in the array
                                imagePreview.alt = 'Current Image';
                                imagePreview.style.display = 'block';

                                // Optionally, add logic to handle multiple images (e.g., a gallery or carousel)
                            } else {
                                // If it's not an array, treat it as a single image URL
                                imagePreview.src = imageLink;
                                imagePreview.alt = 'Current Image';
                                imagePreview.style.display = 'block';
                            }
                        } catch (e) {
                            // If parsing fails, assume it's a single image URL and display it
                            imagePreview.src = imageLink;
                            imagePreview.alt = 'Current Image';
                            imagePreview.style.display = 'block';
                        }
                    }

                    document.getElementById('edit-form').action = updateUrl;

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