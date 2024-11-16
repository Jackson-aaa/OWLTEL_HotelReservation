<link rel="stylesheet" href="{{ asset('css/components/navbar.css') }}">

<nav>
    <div class="left-button">
        @if (Auth::check() && Auth::user()->type === 'admin')
            <div class="hamburger-icon" id="hamburger" onclick="toggleSidebar()">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        @else
            <a href="/"><img src="{{ asset('img/owl_logo.png') }}" alt="Logo"></a>
        @endif
    </div>
    <div>
        
    @if (!(Auth::check() && Auth::user()->type === 'admin'))
        <form class="search-form" method="GET" action="{{route('customer_dashboard')}}">
            <input type="text" placeholder="Search destination" class="search-input" name="search_input" value="{{ request('search_input') }}" required>
            <div class="divider"></div>
            <div class="input-container">
                <i class="fa-solid fa-calendar-days"></i>
                <input type="text" placeholder="Check In" name="check_in" id="check_in" value="{{ request('check_in') }}" autocomplete="off" required>
            </div>
            <div class="divider"></div>
            <div class="input-container">
                <i class="fa-solid fa-calendar-days"></i>
                <input type="text" placeholder="Check Out" name="check_out" id="check_out" value="{{ request('check_out') }}" autocomplete="off" required>
            </div>
            <button type="submit" class="search-button">
                <i class="fa-solid fa-search"></i>
            </button>
        </form>
    @endif

    </div>
    <div class="auth-button">
        @guest
            <a id="sign-in" href="{{route("auth", ["action" => "signin"])}}">Sign In</a>
            <a id="sign-up" href="{{route("auth", ["action" => "signup"])}}">Sign Up</a>
        @endguest
        @auth
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="{{ route('logout') }}" id="sign-out"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Sign Out
            </a>
        @endauth
    </div>
</nav>

<script>
$(function () {
    var checkIn = $("#check_in");
    var checkOut = $("#check_out");

    function parseDate(dateStr) {
        if (!dateStr) return null;
        var parts = dateStr.split("-");
        return new Date(parts[2], parts[1] - 1, parts[0]);
    }

    checkIn.datepicker({
        dateFormat: "dd-mm-yy",
        minDate: 0,
        onSelect: function (selectedDate) {
        var minDate = parseDate(selectedDate);
        checkOut.datepicker("option", "minDate", minDate);
        },
    });

    checkOut.datepicker({
        dateFormat: "dd-mm-yy",
        onSelect: function (selectedDate) {
        var maxDate = parseDate(selectedDate);
        if (maxDate) {
            checkIn.datepicker("option", "maxDate", null);
        }
        },
    });
});
</script>