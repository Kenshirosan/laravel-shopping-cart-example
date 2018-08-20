<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Store CSRF token for AJAX calls -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="/css/link.css">
    @yield('extra-css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="/css/app.css">
    <!-- Favicon and Apple Icons -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
    {{-- Stripe recommends to put this script on all pages, helps ID not good behaviors --}}
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <div id="app">
        @include('includes.header')
        @include('includes.messages')
        @yield('content')
        <flash message="{{ session('flash') }}"></flash>
        <view-cart :items="{{ Cart::content() }}" :total="{{ Cart::total() }}"></view-cart>
    </div>


    @include('includes.footer')
    <script>
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            // Submit the form
            form.submit();
        }
    </script>
    <script src="/js/app.js"></script>
    @yield('pickup-script')
    @yield('dropdown')
</body>
</html>
