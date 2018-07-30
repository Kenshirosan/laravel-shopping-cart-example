@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="text-primary text-center">Hello, {{ auth()->user()->name }}</h1>
        <hr>
        @include('includes.addProductForm')
    </div>
</div>
<hr>
    <latest-orders></latest-orders>
@endsection
