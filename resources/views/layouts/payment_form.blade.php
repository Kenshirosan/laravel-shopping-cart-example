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
                        <h4 class="text-right text-success" style="padding-right:10px;"><span>Subtotal : $</span>{{ Cart::subtotal() / 100}}</h4>
                        <h4 class="text-right text-success" style="padding-right:10px;"><span>taxes : $</span>{{ Cart::tax() / 100}}</h4>
                        <h4 class="text-right text-success" style="padding-right:10px;"><span>Total : $</span>{{ Cart::total() / 100}}</h4>
                        @if($discount != null)
                            <span class="text-info">Congratulations ! {{ $discount * 100 }} % discount applied with code {{ $code }}</span>
                            <h4 class="text-right text-success" style="padding-right:10px;"><span>Total including discount : $</span>{{ $total / 100  }}</h4>
                        @endif
                    </div> <!--end panel-->
                    <!--REVIEW ORDER END-->
                </div>
                @if( Auth::user() )
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">
                        <!--SHIPPING METHOD-->
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <p>Your informations</p>
                                <small>
                                    <p>Your credit card number is not stored anywhere and never touches our server.</p>
                                    <p>Our secure payment provider takes it from here.</p>
                                </small>
                            </div>
                            <div class="panel-body">

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <h4>Shipping Address</h4>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-xs-12">
                                        <strong>First Name:</strong>
                                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" />
                                    </div>
                                    <div class="span1"></div>
                                    <div class="col-md-6 col-xs-12">
                                        <strong>Last Name:</strong>
                                        <input type="text" name="last_name" class="form-control" value="{{ Auth::user()->last_name }}" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                    <strong>Address: </strong><span class="text-info text-center">You may modify the address field if you wish to be delivered somewhere else</span>
                                        <input type="text" name="address" class="form-control" value=" {{ Auth::user()->address }} " />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12"><strong>Address 2:</strong></div>
                                    <div class="col-md-12">
                                        <input type="text" name="address2" class="form-control" value="{{  Auth::user()->address2 }}" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12"><strong>Zipcode:</strong></div>
                                    <div class="col-md-12">
                                        <select id="zipcode" name="zipcode" class="form-control" value="{{ Auth::user()->zipcode }}">
                                            <option value="{{ Auth::user()->zipcode }}">{{ Auth::user()->zipcode }}</option>
                                            <option value="10001">10001</option>
                                            <option value="10002">10002</option>
                                            <option value="10003">10003</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12"><strong>Phone Number:</strong></div>
                                    <div class="col-md-12">
                                        <input type="tel" readonly name="phone_number" class="form-control" value="{{ Auth::user()->phone_number }}" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12"><strong>Email Address:</strong></div>
                                    <div class="col-md-12">
                                        <input type="email" readonly name="email" class="form-control" value="{{ Auth::user()->email }}" />
                                    </div>
                                </div>
                            <input type="hidden" name="code" value="{{ $code }}">
                            <input type="hidden" name="total" value="{{ $total }}">
                                <!--SHIPPING METHOD END-->
                        @if(Cart::total() > 1500)
                            <div class="form-row">
                                <label for="card-element">
                                  Credit or debit card
                                </label>
                                <div id="card-element">
                                  <!-- a Stripe Element will be inserted here. -->
                                </div>

                                <!-- Used to display form errors -->
                                <div id="card-errors" role="alert"></div>
                            </div>
                            <checkoutform></checkoutform>
                        @else
                            <small class="text-danger">You need to order at least $15 worth to order</small>
                        @endif
                    </div>
                </div>
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
