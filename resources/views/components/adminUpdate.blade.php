@section('cssStyles')
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

<div class="modal-container" id="modal-container">
    <div id="{{ $modalId }}" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('{{ $modalId }}')">&times;</span>
            <p class="modal-title">{{$actionName}}</p>
            <form class="adm-form" action="{{ $actionRoute }}" method="POST">
                @csrf
                {{ $slot }}
            </form>
        </div>
    </div>
</div>


