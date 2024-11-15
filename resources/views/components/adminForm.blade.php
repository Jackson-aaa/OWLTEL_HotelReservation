@section('cssStyles')
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

<div class="modal-container" id="{{ $modalIdContainer }}">
    <div id="{{ $modalId }}" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('{{ $modalId }}')">&times;</span>
            <p>{{$actionRoute}}</p>
            <p class="modal-title">{{$actionName}}</p>
            <form id="{{ $id }}" class="adm-form" action="{{ $actionRoute }}" method="{{$method}}">
                <input type="hidden" name="page" value="{{ request()->query('page', 1) }}">
                @csrf
                {{ $slot }}
            </form>
        </div>
    </div>
</div>