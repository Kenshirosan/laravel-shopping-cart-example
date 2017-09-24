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

    @foreach ($categories as $category)

        @if( ! $category->products->isEmpty())
            <div class="row">
                <div class="well text-center">
                    <h1>{{ $category->name }}</h1>
                </div>
                @foreach($category->products as $product)
                    @include('includes.productslayout')
                @endforeach

                @include('includes.goToCartButton')
            </div>
        @endif
    @endforeach


    <div class="container text-center">
        <a href="#top" class="btn btn-info">Back to top</a>
    </div>

@endsection