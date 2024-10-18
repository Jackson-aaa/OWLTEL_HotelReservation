<div>
    <div class="upper">
        <div class="table-name">
            {{$tableName}}
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search..." wire:model="searchTerm">
        </div>
    </div>
    
    <div class="add">
        <button onclick="openModal('addLocationModal')">+</button>
    </div>
    <table>
        <thead>
            <tr>
                @foreach($displayNames as $displayName)
                    <th>{{ $displayName }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $row)
                <tr>
                    @foreach($columns as $column)
                        <td>{{ $row[$column] ?? 'N/A' }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
    @if ($rows instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="pagination">
            {{ $rows->links() }}
        </div>
    @endif

    <x-adminForm 
        modalId="addLocationModal"
    />

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            const modal = document.getElementById(event.target.id);
            if (modal) {
                closeModal(event.target.id);
            }
        }
    </script>
</div>
