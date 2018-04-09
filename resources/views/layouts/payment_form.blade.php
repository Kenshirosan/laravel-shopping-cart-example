@extends('layouts.masterPageForPayment')

@section('title')
    Checkout
@endsection

@section('content')

    <div class="container wrapper">
        <div class="row cart-body">
            <form class="form-horizontal" method="POST" action="/order" id="payment-form">
                @include('includes.error')
                {{ csrf_field() }}
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-push-6 col-sm-push-6">
                    <!--REVIEW ORDER-->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Review Your Order
                        </div>

                        @foreach (Cart::content() as $item)
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="col-sm-3 col-xs-3">
                                        <img src="{{ asset('img/' . $item->model->image) }}" alt="product" class="img-responsive cart-image">
                                    </div>
                                    <div class="col-sm-6 col-xs-6">
                                        <div class="col-xs-12">{{ $item->name }}</div>
                                        <div class="col-xs-12">
                                            <small>Quantity:<span>{{ $item->qty }}</span></small>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-xs-3 text-right">
                                        <h6><span>$</span>{{ $item->subtotal /100 }}</h6>
                                    </div>
                                    <div class="spacer"></div>
                                </div>
                            </div>
                        @endforeach

                        <h4 class="text-right text-success pr-10"><span>Subtotal : $</span>{{ Cart::subtotal() / 100}}</h4>
                        <h4 class="text-right text-success pr-10"><span>taxes : $</span>{{ Cart::tax() / 100}}</h4>
                        <h4 class="text-right text-success pr-10"><span>Total : $</span>{{ Cart::total() / 100}}</h4>
                        @if($discount != null)
                            <span class="text-info">Congratulations ! {{ $discount * 100 }} % discount applied with code {{ $code }}</span>
                            <h4 class="text-right text-success pr-10"><span>Total including discount : $</span>{{ $total / 100  }}</h4>
                            @endif
                    </div> <!--end panel-->
                    <!--REVIEW ORDER END-->
                </div>
                @if( Auth::user() )

                    @include('includes.form')


            @if(Cart::total() > 1500)
            <hr>
                <checkoutform></checkoutform>
            @else
                <small class="text-danger">You need to order at least $15 worth to order</small>
            @endif
        </div>
            @endif
            </form>
        {{-- COUPON --}}
        <div class="container text-right">
            <h2>Do you have a coupon ?</h2>
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