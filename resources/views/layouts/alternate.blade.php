@extends('layouts.master')

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
        <div id="index-banner" class="alternate-parallax-container jumbotron">
            <div class="section">
                <div class="container">
                    <h1 class="header center-align text-lighten-2 custom-title"></h1>
{{--                    <div class="row">--}}
{{--                        <h5 class="custom-subtitle center-align header light"></h5>--}}
{{--                    </div>--}}
                    <div class="row">
                        <todays-special-slider></todays-special-slider>
                    </div>
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
                        @include('includes.alt-card')
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
