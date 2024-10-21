<div>
    <div class="upper">
        <div class="table-name">
            {{$tableName}}
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
    </div>
    
    @if ($rows instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="pagination">
            {{ $rows->links() }}
        </div>
    @endif
</div>


