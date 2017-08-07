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
                <a class="navbar-brand" href="{{ url('/') }}">Your order</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="{{ set_active('/') }}"><a href="{{ url('/shop') }}">Regular Menu</a></li>
                    <li class="{{ set_active('/daily-specials') }}"><a href="{{ url('/daily-specials') }}" style="color:blue;">Daily Specials</a></li>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if ( Auth::guest() )
                        <li><a href="/login">Sign in</a></li>
                        <li><a href="/register">Register</a></li>
                    @elseif ( Auth::check() )
                        <li><a href="/edit-profile">Your profile</a></li>
                        <li>
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Logout</a>
                        </li>

                        @if( Auth::user()->isAdmin() )
                            <li><a href="/restaurantpanel">Admin</a></li>
                        @endif
                        @if(  Auth::user()->employee )
                            <li><a href="/customer-orders">Today's order</a></li>
                        @endif
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
                <li class="{{ set_active('cart') }}"><a href="{{ url('/cart') }}">Cart ({{ Cart::instance()->count() }})</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

</header>