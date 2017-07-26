@extends('layouts.master')

@section('title')
    Our Daily Specials
@endsection

@section('content')
    <div class="jumbotron text-center clearfix">
        <h2>Name of your restaurant</h2>
        <p>Place your order !</p>

    </div> <!-- end jumbotron -->



    @foreach ($dailys->chunk(4) as $items)
        <div class="response"></div>
        <a href="{{ url('/cart') }}" class="btn btn-info pull-right">Go to cart</a>
        <div class="row">
            <h1>Daily Specials</h1>
            
            @include('includes.productslayout')

        </div> <!-- end row -->
    @endforeach
    

</div> <!-- end row -->

<div class="container text-center">
    <a href="#top" class="btn btn-info">Back to top</a>
</div>


@endsection

@section('ajax')
    @include('javascript.addToCart')
@endsection
