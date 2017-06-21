@extends('layouts.master')

@section('content')
    <div class="container">


    <h1>Thank You, {{ Auth::user()->name }}</h1>

    @if (session()->has('success_message'))
        <div class="alert alert-success">
            {{ session()->get('success_message') }}
        </div>
    @endif

    @if (session()->has('error_message'))
        <div class="alert alert-danger">
            {{ session()->get('error_message') }}
        </div>
    @endif

    </div>
@endsection
