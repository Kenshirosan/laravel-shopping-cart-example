<header>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="{{ set_active('/') }}"><a href="{{ url('/shop') }}">Our Menu</a></li>
                    @if( App\Product::where('holiday_special', true)->exists() && $title != null)
                        <li class="{{ set_active('/') }}">
                            <a href="{{ url('/holidays-special') }}">{{ $title }}</a>
                        </li>
                    @endif
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/contact-us">Contact</a></li>
                    @if ( Auth::guest() )
                        <li><a href="/login">Sign in</a></li>
                        <li><a href="/register">Register</a></li>
                    @elseif ( Auth::check() )
                        @if(! auth()->user()->isEmployee())
                            <li><a href="/edit/profile">Your profile</a></li>
                        @endif
                        <li>
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Logout</a>
                        </li>

                        @can('see-admin-menu')
                            <li><a href="/restaurantpanel">Admin</a></li>
                        @endcan
                        @can('see-employee-menu')
                            <li><a href="/customer-orders">Today's order</a></li>
                            <li><a href="/calendar">Calendar</a></li>
                        @endcan
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <li>
                                    <a href="/edit/profile">Profile</a>
                                </li>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
                    <li>
                        <a type="button" class="btn" data-toggle="modal" data-target=".modal">Preview Cart</a>
                    </li>

                    <cart-counter :numberofitems="{{ Cart::instance()->count() }}"></cart-counter>

            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

</header>
