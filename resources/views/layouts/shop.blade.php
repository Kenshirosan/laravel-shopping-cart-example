@extends('layouts.master')

@section('title')
    Shop with us
@endsection

@section('content')
 <noscript>
     <h1 style="color:red">Javascript must be enabled past this point, please check how to activate javascript for your browser</h1>
 </noscript>

        <div class="jumbotron text-center clearfix">
            <h2>Name of your restaurant</h2>
            <p>Place your order !</p>
        </div>

        @foreach ($dailys->chunk(4) as $items)

            <div class="row">
                <div class="well text-center">
                    <h1>Daily Specials</h1>
                </div>

               @include('includes.productslayout')
               @include('includes.goToCartButton')

            </div>
        @endforeach

        {{--  Appetizers --}}
        @foreach ($appetizers->chunk(4) as $items)

            <div class="row">
                <div class="well text-center">
                    <h1>Appetizers</h1>
                </div>

               @include('includes.productslayout')
               @include('includes.goToCartButton')

            </div>
        @endforeach

        {{--  Main --}}
        @foreach ($main->chunk(4) as $items)



            <div class="row">
                <div class="well text-center">
                    <h1>Meat and Fish</h1>
                </div>

                @include('includes.productslayout')
                @include('includes.goToCartButton')

            </div>
        @endforeach

        {{--  Burgers and sandwiches --}}
        @foreach ($burgers->chunk(4) as $items)



            <div class="row">

                <div class="well text-center">
                    <h1>Burgers and sandwiches</h1>
                </div>

                @include('includes.productslayout')
                @include('includes.goToCartButton')

            </div>
        @endforeach

        {{--  Desserts --}}
        @foreach ($dessert->chunk(4) as $items)


            <div class="row">
                <div class="well text-center">
                    <h1>Desserts</h1>
                </div>

                @include('includes.productslayout')
                @include('includes.goToCartButton')

            </div>
        @endforeach

        {{--  Drinks --}}
        @foreach ($drinks->chunk(4) as $items)


            <div class="row">
                <div class="well text-center">
                    <h1>Drinks</h1>
                </div>

                @include('includes.productslayout')
                @include('includes.goToCartButton')

            </div>
        @endforeach
        <div class="container text-center">
            <a href="#top" class="btn btn-info">Back to top</a>
        </div>

@endsection