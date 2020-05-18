@extends('layouts.master')

@section('landing-css')
    <link rel="stylesheet" href="/css/alternate.css">
@endsection

@section('title')
    Shop with us
@endsection

@section('content')
    <noscript>
        <div class="row">
            <div class="alert red">
                <h1>Javascript must be enabled to shop on this website, please check how to activate javascript for your browser</h1>
            </div>
        </div>
    </noscript>

    <section class="shopping menu">
        <div id="index-banner" class="parallax-container jumbotron">
            <div class="section no-pad-bot">
                <div class="container">
                    {{-- <br><br> --}}
                    <h1 class="header center-align text-lighten-2 custom-title"></h1>
                    <div class="row">
                        <h5 class="custom-subtitle center-align header light"></h5>
                    </div>
                    <div class="center-align">
                        <a href="#cat" id="download-button" class="btn-large waves-effect waves-light teal lighten-1">Start Ordering</a>
                    </div>
                    <br><br>
                </div>
            </div>
        </div>
        <div class="btnalt-container">
            <button class="filter-btn" type="button" data-id="All">Tout</button>
            @foreach ($categories as $category)
                @if(! $category->products->isEmpty())
                    <button class="filter-btn" type="button" data-id="{{ $category->name }}">{{ $category->name }}</button>
                @endif
            @endforeach
        </div>
        <div class="section-center">
            @foreach ($categories as $category)
                @foreach($category->products as $product)
                    @if(! $category->products->isEmpty())
                        <article class="menu-item" data-category="{{ $category->name  }}">
                            <img src="/img/{{  $product->image }}"
                                 alt=""
                                 class="photo">
                            <div class="item-info">
                                <header>
                                    <h4>{{ $product->name }}</h4>
                                    <h4 class="price">{{ $product->price()  }}</h4>
                                </header>
                                <p class="item-text">
                                    {{ $product->description }}
                                </p>
                                @if($product->is_eighty_six())
                                    <img class="activator sold-out right" src="/images/sold_out_stamp_cropped.jpg" alt="Product sold out !">
                                @else
                                    <add-to-cart
                                            :product="{{ $product }}"
                                            @if( $product->groups )
                                            :options="{{ $product->groups }}"
                                            @endif
                                            @if( $product->getWaysOfCooking() )
                                            :waysOfCooking="{{ $product->getWaysOfCooking() }}"
                                            @endif
                                    >
                                    </add-to-cart>
                                @endif
                                <favorite class="ml-20 mt-15" :product="{{ $product }}"></favorite>
                                @if($_SERVER['REQUEST_URI'] != "/shop/$product->slug")
                                    <a class="btn-small mt-15 cyan right" href="/shop/{{ $product->slug }}">Voir</a>
                                @endif
                            </div>
                        </article>
                    @endif
                @endforeach
            @endforeach
        </div>
    </section>

@endsection

@section('delete-product-script')
    @include('javascript.confirmProductDeletion')
@endsection

@section('title-script')
    @include('javascript.title-script')
@endsection

@section('menu-script')
    @include('javascript.menu-script')
@endsection