@section('cssStyles')
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

<div class="modal-container" id="modal-container">
    <div id="{{ $modalId }}" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('{{ $modalId }}')">&times;</span>
            <p>{{$tableName}}</p>
            <form action="{{ route('locations.store') }}" method="POST">
            @csrf
            {{ $slot }}
            <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>


