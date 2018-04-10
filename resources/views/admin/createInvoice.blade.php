@extends('adminlte::page')

@section('title')
    Create An Invoice
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel-body">
                @foreach($products as $product)
                    <div class="col-md-2">
                        <p>{{ $product->name }}</p>
                            <img src="{{ asset('img/' . $product->image) }}" alt="product" class="img-responsive product-layout-img">
                        <add-to-cart
                            :product="{{ $product }}"
                            @if( $product->group )
                                :options="{{ $product->options() }}"
                            @endif
                            @if( $product->secondGroup )
                                :secondoptions="{{ $product->secondOptions() }}"
                            @endif
                        >
                        </add-to-cart>
                    </div>
                @endforeach
            </div>
            <a href="/cart" class="btn btn-success">Go to cart</a>
        </div>
    </div>
@endsection