@extends('layouts.master')

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
        <div class="jumbotron text-center clearfix text-white">
            <h2 class="custom-title">{{ config('app.name') }}</h2>
            <p class="custom-subtitle">Place your order !</p>
        </div>
        @foreach ($categories as $category)
            @if(! $category->products->isEmpty())
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
    </section>

@endsection

@section('delete-product-script')
    @include('javascript.confirmProductDeletion')
@endsection

@section('title-script')
    @include('javascript.title-script')
@endsection