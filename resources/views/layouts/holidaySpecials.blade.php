@extends('layouts.master')

@section('title')
    Holiday Specials
@endsection

@section('content')
    @foreach($products as $product)
        @include('includes.productslayout')
    @endforeach
@endsection