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
    <link rel="stylesheet" href="/css/app.css">
    @yield('extra-css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="/css/custom.css">

    <!-- Favicon and Apple Icons -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
</head>
    <body>
        @include('includes.header')
        <div class="container" id="app">
            @include('messages.messages')
            @yield('content')
            <flash message="{{ session('flash') }}"></flash>
        </div>
        @include('includes.footer')

        <!-- JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="/js/app.js"></script>
        <script src="/js/smoothscroll.js" charset="utf-8"></script>

        @yield('extra-js')
        @yield('dropzone.script')

    </body>
</html>
