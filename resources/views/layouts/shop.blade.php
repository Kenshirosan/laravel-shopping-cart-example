@extends('layouts.master')

@section('title')
    Shop with us
@endsection

@section('content')

        <div class="jumbotron text-center clearfix">
            <h2>Name of your restaurant</h2>
            <p>Place your order !</p>

        </div> <!-- end jumbotron -->


        {{--  Appetizers --}}
        @foreach ($appetizers->chunk(4) as $items)
            <div class="response"></div>
            <a href="{{ url('/cart') }}" class="btn btn-info pull-right">Go to cart</a>
            <div class="row">
                <h1>Appetizers</h1>

               @include('includes.productslayout')

            </div> <!-- end row -->
        @endforeach

        {{--  Main --}}
        @foreach ($main->chunk(4) as $items)
            <div class="response"></div>
            <a href="{{ url('/cart') }}" class="btn btn-info pull-right">Go to cart</a>
            <div class="row">
                <h1>Meat and Fish</h1>

                @include('includes.productslayout')

            </div> <!-- end row -->
        @endforeach

        {{--  Burgers and sandwiches --}}
        @foreach ($burgers->chunk(4) as $items)
            <div class="response"></div>
            <a href="{{ url('/cart') }}" class="btn btn-info pull-right">Go to cart</a>
            <div class="row">
                <h1>Burgers and sandwiches</h1>

                @include('includes.productslayout')

            </div> <!-- end row -->
        @endforeach

        {{--  Desserts --}}
        @foreach ($dessert->chunk(4) as $items)
            <div class="response"></div>
            <a href="{{ url('/cart') }}" class="btn btn-info pull-right">Go to cart</a>
            <div class="row">
                <h1>Desserts</h1>

               @include('includes.productslayout')

            </div> <!-- end row -->
        @endforeach

        {{--  Drinks --}}
        @foreach ($drinks->chunk(4) as $items)
            <div class="response"></div>
            <a href="{{ url('/cart') }}" class="btn btn-info pull-right">Go to cart</a>

            <div class="row">
                <h1>Drinks</h1>

               @include('includes.productslayout')

            </div> <!-- end row -->
        @endforeach
        <div class="container text-center">

            <a href="#top" class="btn btn-info">Back to top</a>
        </div>

@endsection
@section('ajax')
    @include('javascript.addToCart')
@endsection