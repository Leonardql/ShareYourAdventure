<header>
    <h1><a href="/"> Share your adventure</a></h1>
    @guest
    <nav>
        <ul class="main-menu visible-on-click" id="main-menu">
            <li><a href="/">Home</a></li>
            <li><a href="/login">Login</a></li>
            <li><a href="/register">SignUp</a></li>
        </ul>
    </nav>
    @else
    <nav>
        <ul class="main-menu visible-on-click" id="main-menu">
            <li><a href="/">Home</a></li>
            <li><a href="/adventure">Adventures</a> </li>
            <li><a href="/posts/create">Create Post</a></li>
            <li><a href="/home">{{ Auth::user()->name }}</a></li>
            <li><a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            {{--<li><a href="#">{{Auth::logout()}}</a>  </li>--}}

        </ul>
    </nav>

    @endguest


</header>