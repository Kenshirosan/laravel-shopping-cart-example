<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <meta name="description" content="Shopping Cart">
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Store CSRF token for AJAX calls with jquery-->
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
        {{-- @if( $_SERVER['HTTP_HOST'] != 'https://webcreation.rocks')
            {{ die(new Exception()) }}
        @endif --}}
        <div id="app">
            @include('includes.header')
            <div class="container">
                @include('includes.messages')
                @yield('content')
                <flash message="{{ session('flash') }}"></flash>
            </div>
            <div class="container">
                <view-cart :items="{{ Cart::content() }}" :total="{{ Cart::total() }}"></view-cart>
            </div>
        </div>
        @include('includes.footer')

        <!-- JavaScript -->
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> ?Why did I put this already ?? hhmmmmmm--}}
        <script src="/js/app.js"></script>
        <script src="/js/smoothscroll.js" charset="utf-8"></script>
        @yield('extra-js')
        @yield('dropzone.script')
        @yield('lity-js')
    </body>
</html>
