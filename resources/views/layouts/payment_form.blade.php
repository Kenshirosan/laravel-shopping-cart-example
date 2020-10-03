@extends('layouts.masterPageForPayment')

@section('title')
    Checkout
@endsection

@section('content')
    <div class="row">
        <h2 class="center">Votre Commande</h2>
        @include('includes.error')
        <form class="form-horizontal" method="POST" action="/order" id="payment-form">
            {{ csrf_field() }}
            <div class="col m4 s12">
                <!--REVIEW ORDER-->
                @foreach (Cart::content() as $item)
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title cyan-text">{{ $item->name }}</span>
                            <img src="{{ asset('img/' . $item->model->image) }}" alt="product" class="img-responsive cart-image">
                            @include('includes.cart-content-options')
                            <p><small class="blue-text">Quantity:<span>{{ $item->qty }}</span></small></p>
                            <h6><span>$</span>{{ $item->subtotal }}</h6>
                        </div>
                    </div>
                @endforeach

                <cart-total-price></cart-total-price>
            </div>
            <div class="col m6 s12">
                @if( Auth::check() )
                    @include('includes.form')
                @endif
                @if(Cart::total() > 15)
                    <checkoutform></checkoutform>
                @else
                    <small class="text-red">You need to order at least $15 worth to order</small>
                @endif
            </div>
        </form>

    <add-coupon-to-cart></add-coupon-to-cart>
</div>
@endsection
