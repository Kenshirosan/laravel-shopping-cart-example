@extends('layouts.master')

@section('landing-css')
    <link rel="stylesheet" href="/css/landing.css">
@endsection

@section('title')
    Shop with us
@endsection

@section('content')
    <noscript>
        <div class="row">
            <div class="alert alert-danger">
                <h1>Javascript must be enabled to shop on this website, please check how to activate javascript for your browser</h1>
            </div>
        </div>
    </noscript>

    <section class="shopping">
        <div id="index-banner" class="parallax-container jumbotron">
            <div class="section no-pad-bot">
                <div class="container">
                <br><br>
                    <h1 class="header center teal-text text-lighten-2 custom-title"></h1>
                        <div class="row center">
                            <h5 class="custom-subtitle header col s12 light"></h5>
                        </div>
                        <div class="row center">
                            <a href="#cat" id="download-button" class="btn-large waves-effect waves-light teal lighten-1">Start Ordering</a>
                        </div>
                <br><br>
                </div>
            </div>
            <div class="parallax"><img src="/img/caviar.jpg" alt="Unsplashed background img 1"></div>
        </div>
        @foreach ($categories as $category)
            @if(! $category->products->isEmpty())
                <div class="row" id="cat">
                    <div class="well center container">
                        <h1 class="category-title cyan-text">{{ $category->name }}</h1>
                    </div>
                    @foreach($category->products as $product)
                        @include('includes.productslayout')
                    @endforeach
                    @include('includes.goToCartButton')
                </div>
            @endif
        @endforeach
    </section>

@endsection

@section('delete-product-script')
    @include('javascript.confirmProductDeletion')
@endsection

@section('title-script')
    @include('javascript.title-script')
@endsection