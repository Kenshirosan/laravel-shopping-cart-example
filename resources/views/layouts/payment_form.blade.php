@extends('layouts.masterPageForPayment')

@section('title')
    Checkout
@endsection

@section('content')
    <div class="row">
        @include('includes.error')
        <form class="form-horizontal" method="POST" action="/order" id="payment-form">
            {{ csrf_field() }}
            <div class="col s4">
                <!--REVIEW ORDER-->
                <div class="card">
                    <div class="card-title">
                        Review Your Order
                    </div>
                    <div class="card-content">
                        @foreach (Cart::content() as $item)
                            <img src="{{ asset('img/' . $item->model->image) }}" alt="product" class="img-responsive cart-image">
                            {{ $item->name }}
                            <small class="blue-text">Quantity:<span>{{ $item->qty }}</span></small>
                            <h6><span>$</span>{{ $item->subtotal /100 }}</h6>
                        @endforeach
                        <h5 class="cyan-text pr-10"><span>Subtotal : $</span>{{ Cart::subtotal() / 100}}</h5>
                        <h5 class="cyan-text pr-10"><span>taxes : $</span>{{ Cart::tax() / 100}}</h5>
                        <h5 class="cyan-text pr-10"><span>Total : $</span>{{ Cart::total() / 100}}</h5>
                        @if($discount != null)
                            <span class="text-info">Congratulations ! {{ $discount * 100 }} % discount applied with code {{ $code }}</span>
                            <h5 class="cyan-text pr-10"><span>Total including discount : $</span>{{ $total / 100  }}</h5>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col s6">
                @if( Auth::check() )
                    @include('includes.form')
                @endif
                @if(Cart::total() > 1500)
                <hr>
                    <checkoutform></checkoutform>
                @else
                    <small class="text-danger">You need to order at least $15 worth to order</small>
                @endif
            </div>
        </form>
    {{-- COUPON --}}
    <div class="col s2">
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
@endsection