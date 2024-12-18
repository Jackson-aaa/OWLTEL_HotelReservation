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
            <form class="search-form">
                @csrf
                <input type="text" placeholder="Search destination" class="search-input" name="destination" required>
                <div></div>
                <input type="datetime" placeholder="Check In" name="checkin" required>
                <div></div>
                <input type="datetime" placeholder="Check Out" name="checkout" required>
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
            @if (!(Auth::check() && Auth::user()->type !== 'admin'))

                <a href="{{ route('logout') }}" id="sign-out"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Sign Out
                </a>
            @else
                <div class="btn-group">
                    <a data-bs-toggle="dropdown" href="" type="button">
                        Profile
                    </a>
                    <ul class="dropdown-menu">
                        <li class="p-1"><a href="{{route('bookinghistory')}}">Booking History</a></li>
                        <li class="p-1">
                            <a href="{{ route('logout') }}" id="sign-out"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Sign Out
                            </a>
                        </li>
                    </ul>
                </div>
            @endif
        @endauth
    </div>
</nav>