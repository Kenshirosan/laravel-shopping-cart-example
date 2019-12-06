@extends('layouts.masterPageForPayment')

@section('title')
    Checkout
@endsection

@section('content')
    <div class="row">
        @include('includes.error')
        <form class="form-horizontal" method="POST" action="/order" id="payment-form">
            {{ csrf_field() }}
            <div class="col m4 s12">
                <!--REVIEW ORDER-->
                <h2>Review Your Order</h2>
                @foreach (Cart::content() as $item)
                    <div class="card">
                        <div class="card-title">
                            <p>{{ $item->name }}</p>
                        </div>
                        <div class="card-content">
                            <img src="{{ asset('img/' . $item->model->image) }}" alt="product" class="img-responsive cart-image">
                            @include('includes.cart-content-options')
                            <p><small class="blue-text">Quantity:<span>{{ $item->qty }}</span></small></p>
                            <h6><span>$</span>{{ $item->subtotal }}</h6>
                        </div>
                    </div>
                @endforeach
                <div class="card">
                    <div class="card-title">
                        <p>The moneyyy !</p>
                    </div>
                    <div class="card-content">
                        <h5 class="cyan-text pr-10"><span>Subtotal : $</span>{{ Cart::subtotal() }}</h5>
                        <h5 class="cyan-text pr-10"><span>taxes : $</span>{{ Cart::tax() }}</h5>
                        <h5 class="cyan-text pr-10"><span>Total : $</span>{{ Cart::total() }}</h5>
                        @if($discount != null)
                            <span class="text-info">Congratulations ! {{ $discount * 100 }} % discount applied with code {{ $code }}</span>
                            <h5 class="cyan-text pr-10"><span>Total including discount : $</span>{{ $total / 100  }}</h5>
                        @endif
                    </div>
                </div>
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
    {{-- COUPON --}}
    <div class="row">
        <div class="col m2 s12">
            <p class="blue-text">Do you have a coupon ?</p>
            <div class="form-group">
                <form action="/apply-coupon" method="POST" class="side-by-side">
                    {{ csrf_field() }}
                    <div class="col-md-6">
                        <input type="text" name="coupon" placeholder="R5AH-JHXE">
                    </div>
                    <div class="col-md-6">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection