<header>
     <nav class="altheader">
        <div class="container">
            <div class="nav-wrapper">
                <a class="brand-logo" href="{{ url('/') }}">{{ config('app.name') }}</a>
                <a href="#" data-target="mobile-nav" class="sidenav-trigger">
                    <i class="material-icons">menu</i>
                </a>
                @include('includes.locale')
                <ul class="right hide-on-med-and-down">
{{-- TODO: correct this syntax --}}
                    @if( App\Models\Product::where('holiday_special', true)->exists() && $title != null)
                        <li class="{{ set_active('/holidays-special') }}">
                            <a class="waves-effect waves-light" href="{{ url('/holidays-special') }}">{{ $title }}</a>
                        </li>
                    @endif
                    <li><a class="waves-effect waves-light" href="/about">About Us</a></li>
                    <li><a class="waves-effect waves-light" href="/contact-us">Contact</a></li>
                    @if ( Auth::guest() )
                        <li><a href="/login" class="waves-effect waves-light">Login</a></li>
                        <li><a href="/register" class="waves-effect waves-light">Register</a></li>
                    @elseif ( Auth::check() )
                        @can('see-admin-menu')
                            <li><a class="waves-effect waves-light" href="/restaurantpanel">Admin</a></li>
                        @endcan
                        @can('see-employee-menu')
                            <li><a class="waves-effect waves-light" href="/customer-orders">Today's order</a></li>
                            <li><a class="waves-effect waves-light" href="/calendar">Calendar</a></li>
                        @endcan
                        <li>
                            <a
                                class="cyan dropdown-button"
                                role="button"
                                href="#!"
                                data-target="dropdown1">
                            <i class="material-icons right">person arrow_drop_down</i>
                            </a>
                            <!-- Dropdown Structure -->
                            <ul id="dropdown1" class="dropdown-content">
                                <li>
                                    <a
                                        href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                </li>
                                <li>
                                    <a href="/user/profile">Profile
                                        <i class="material-icons right">person</i>
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    {{ csrf_field() }}
                                </form>
                            </ul>
                        </li>
                    @endif
                    <li>
                        <button
                            type="button"
                            class="btn modal-trigger waves-effect waves-white"
                            data-target="modal">Preview Cart
                        </button>
                    </li>
                    <li>
                        <a href="#!">
                            <cart-counter numberofitems="{{ Cart::instance()->count() }}"></cart-counter>
                        </a>
                    </li>

                </ul>
                <ul class="sidenav" id="mobile-nav">
                    @if( App\Models\Product::where('holiday_special', true)->exists() && $title != null)
                        <li class="{{ set_active('/holidays-special') }}">
                            <a href="{{ url('/holidays-special') }}">{{ $title }}</a>
                        </li>
                    @endif
                    <li><a href="/about">About Us</a></li>
                    <li><a href="/contact-us">Contact</a></li>
                    @if ( Auth::guest() )
                        <li><a href="/login" class="btn waves-effect waves-light">Login</a></li>
                        <li><a href="/register" class="btn waves-effect waves-light">Register</a></li>
                    @elseif ( Auth::check() )
                        @if(! auth()->user()->isEmployee())
                            <li><a href="/user/profile">Your profile</a></li>
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
                        <li>
                            <a
                                class="btn dropdown-button"
                                role="button"
                                href="#!"
                                data-target="dropdown3">{{ Auth::user()->name }}
                            <i class="material-icons right">arrow_drop_down</i>
                            </a>
                            <!-- Dropdown Structure -->
                            <ul id="dropdown3" class="dropdown-content">
                                <li>
                                    <a
                                        href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                </li>
                                <li>
                                    <a href="/user/profile">Profile
                                        <i class="material-icons right">person</i>
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    {{ csrf_field() }}
                                </form>
                            </ul>
                        </li>
                    @endif
                    <li>
                        <a href="">
                            <cart-counter numberofitems="{{ Cart::instance()->count() }}"></cart-counter>
                        </a>
                    </li>
                    <li>
                        <a
                            type="button"
                            class="btn modal-trigger waves-effect cyan waves-cyan"
                            data-target="modal">Preview Cart
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

@section('dropdown')
<script>
    $(document).ready(function () {
        $('.dropdown-button').dropdown({
            constrainWidth: false,
            hover: true,
            belowOrigin: true,
            alignment: 'left'
        });

        $('.modal').modal();

        $('.modal-trigger').on('click', () => {
            $('.close-modal').on('click', () => {
                M.Modal.getInstance($('#modal')).close();
            })
        });

        $('.sidenav').sidenav();

        $('select').formSelect();

        $('.materialboxed').materialbox();
    });
</script>
@endsection
