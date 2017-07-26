@extends('layouts.master')

@section('content')

    <h1>Thank You, {{ Auth::user()->name }}</h1>

@endsection
