<!--
//                                 __
//                                |  \
//    ______    ______   _______ _| $$_    ______    ______    ______    ______      _______   __    __   _______
//   /      \  /      \ /       \   $$ \  /      \  /      \  /      \  /      \    |       \ |  \  |  \ /       \
//  |  $$$$$$\|  $$$$$$\  $$$$$$$\$$$$$$ |  $$$$$$\|  $$$$$$\|  $$$$$$\|  $$$$$$\   | $$$$$$$\| $$  | $$|  $$$$$$$
//  | $$   \$$| $$    $$\$$    \  | $$ __| $$  | $$| $$  | $$| $$   \$$| $$  | $$   | $$  | $$| $$  | $$| $$
//  | $$      | $$$$$$$$_\$$$$$$\ | $$|  \ $$__/ $$| $$__/ $$| $$      | $$__/ $$ __| $$  | $$| $$__/ $$| $$_____
//  | $$       \$$     \       $$  \$$  $$\$$    $$| $$    $$| $$       \$$    $$|  \ $$  | $$ \$$    $$ \$$     \
//   \$$        \$$$$$$$\$$$$$$$    \$$$$  \$$$$$$ | $$$$$$$  \$$        \$$$$$$  \$$\$$   \$$ _\$$$$$$$  \$$$$$$$
//                                                 | $$                                       |  \__| $$
//                                                 | $$                                        \$$    $$
//                                                  \$$                                         \$$$$$$
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <meta name="description" content="Shopping Cart">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Store CSRF token for AJAX calls-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="/css/dropzone.min.css">
    <link rel="stylesheet" href="/css/link.css">
    @yield('lity-css')
    @yield('extra-css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="/css/app.css">
    <!-- Favicon and Apple Icons -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
    {{-- Stripe recommends to put this script on all pages, helps ID not good behaviors --}}
    <script src="https://js.stripe.com/v3/"></script>
</head>
    <body>
        <div class="container" id="app">
            @include('includes.header')
            @include('includes.messages')
            @yield('content')
            <flash message="{{ session('flash') }}"></flash>
            <view-cart :items="{{ Cart::content() }}" :total="{{ Cart::total() }}"></view-cart>
        </div>
        @include('includes.footer')

        <!-- JavaScript -->
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> ?Why did I put this already ?? hhmmmmmm--}}
        <script src="/js/app.js"></script>
        <script src="/js/smoothscroll.js"></script>
        <script src="/js/back-to-top.js"></script>
        @yield('update-cart')
        @yield('dropzone.script')
        @yield('lity-js')
        @yield('delete-product-script')
        @yield('title-script')
        @yield('about-script')
        <script>
            // added this cause the page loads in the middle, dunno why... So auto scroll to top...
            (function() {
                document.addEventListener('DOMContentLoaded', function() {
                    let scrollTop = $(window).scrollTop();
                    $('html,body').animate({
                        scrollTop: 0
                    }, 100);
                });
            })();
        </script>
    </body>
</html>
