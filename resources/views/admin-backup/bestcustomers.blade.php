@extends('adminlte::page')

@section('title')
    Your best customers
@endsection

@section('content')

    <div class="container text-center mb-100">
        <h1 class="text-info">
            You have <span class="text-info">{{ $user_count }}</span> registered customers.
        </h1>
        <h3>Best Customers in {{ date('Y') }}</h3>
    </div>

    <best-customers></best-customers>
@endsection