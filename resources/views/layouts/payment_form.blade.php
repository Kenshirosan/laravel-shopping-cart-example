@extends('layouts.master')

@section('content')


    <div class="container wrapper">

        <div class="row cart-body">
            @if (session()->has('success_message'))
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
            @endif

            @if (session()->has('warning_message'))
                <div class="alert alert-warning">
                    {{ session()->get('warning_message') }}
                </div>
            @endif

            @if (session()->has('error_message'))
                <div class="alert alert-danger">
                    {{ session()->get('error_message') }}
                </div>
            @endif

            <form class="form-horizontal" method="POST" action="/order">
                @include('layouts.error')
                {{ csrf_field() }}



                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-push-6 col-sm-push-6">
                    <!--REVIEW ORDER-->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Review Order
                        </div>
                        @foreach (Cart::content() as $item)
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="col-sm-3 col-xs-3">
                                        <img src="{{ asset('img/' . $item->model->image) }}" alt="product" class="img-responsive cart-image">
                                    </div>
                                    <div class="col-sm-6 col-xs-6">
                                        <div class="col-xs-12">{{ $item->name }}</div>
                                        <div class="col-xs-12"><small>Quantity:<span>{{ $item->qty }}</span></small></div>
                                    </div>
                                    <div class="col-sm-3 col-xs-3 text-right">
                                        <h6><span>$</span>{{ $item->subtotal /100 }}</h6>
                                    </div>
                                    <div class="spacer"></div>
                                </div>

                                @if( Auth::guest() )
                                    <div class="col-sm-6 col-xs-6">
                                        <div class="col-xs-12">

                                            <a href="/login" class="btn btn-success ">Sign in</a>
                                        </div>
                                    </div>
                                @endif
                            </div>

                        @endforeach
                        <h4 class="text-right text-success" style="padding-right:10px;"><span>Your total : $</span>{{ Cart::total() /100 }}</h4>
                    </div>
                    <!--REVIEW ORDER END-->
                </div>
                @if( Auth::user() )
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">
                        <!--SHIPPING METHOD-->
                        <div class="panel panel-info">
                            <div class="panel-heading">Address</div>
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
                                    <div class="col-md-12"><strong>Address:</strong></div>
                                    <div class="col-md-12">
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
                                    <div class="col-md-12"><input type="tel" name="phone_number" class="form-control" value="{{ Auth::user()->phone_number }}" /></div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12"><strong>Email Address:</strong></div>
                                    <div class="col-md-12"><input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" /></div>
                                </div>

                                <!--SHIPPING METHOD END-->

                                {{-- <div class="form-group">
                                <div class="col-md-12">
                                <input type="submit" class="btn btn-success" value="Pay">
                            </div>
                        </div> --}}
                        @if(Cart::total() > 1500)
                            <form action="/order" method="POST">

                                <script
                                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="{{ config('services.stripe.key') }}"
                                data-amount="{{ Cart::total() }}"
                                data-name="Demo Site"
                                data-description="Widget"
                                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                data-locale="auto"
                                data-currency="usd"
                                data-zip-code="true">
                                </script>
                            </form>
                        @else
                            <small class="text-danger">You need at least $15 to order</small>
                        @endif
                    </div>
                </div>
            @endif

        </form>



        @if( Auth::guest() )
            <form class="form-horizontal" method="POST" action="/register">
                {{ csrf_field() }}
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">
                    <!--SHIPPING METHOD-->
                    <div class="panel panel-info">
                        <div class="panel-heading">Address</div>
                        <div class="panel-body">

                            <div class="form-group">
                                <div class="col-md-12">
                                    <h4>Shipping Address</h4>
                                </div>
                            </div>
                            {{-- <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"> --}}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <strong>First Name:</strong>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="First Name" />
                                </div>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <div class="span1"></div>
                                <div class="col-md-12">
                                    <strong>Last Name:</strong>
                                    <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" placeholder="Last Name" />
                                </div>
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <div class="col-md-12"><strong>Address:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="address" class="form-control" value="{{ old('address') }}" placeholder="Address" />
                                </div>
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
                                <div class="col-md-12"><strong>Address 2:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="address2" class="form-control" value="{{ old('address2') }}" placeholder="Address 2" />
                                </div>
                                @if ($errors->has('address2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address2') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                                <div class="col-md-12"><strong>Zipcode:</strong></div>
                                <div class="col-md-12">
                                    <select id="zipcode" name="zipcode" class="form-control" placeholder="Zipcode">

                                        <option value="10001">10001</option>
                                        <option value="10002">10002</option>
                                        <option value="10003">10003</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                <div class="col-md-12"><strong>Phone Number:</strong></div>
                                <div class="col-md-12"><input type="text" name="phone_number" class="form-control" value="{{ old('phone_number') }}" placeholder="Phone Number" />
                                </div>
                                @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="col-md-12"><strong>Email Address:</strong></div>
                                <div class="col-md-12"><input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Your Email" /></div>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="col-md-12"><strong>Password:</strong></div>
                                <div class="col-md-12"><input type="password" name="password" class="form-control" value="{{ old('password')}}" placeholder="Your Password" /></div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <!--SHIPPING METHOD END-->

                            <div class="form-group">
                                <div class="col-md-12">

                                    <input type="submit" value ="Register" class="btn btn-primary">
                                    {{-- <a href="/login" class="btn btn-success pull-right">Sign in</a> --}}
                                </div>
                            </div>

                        </div>
                    </div>
                @endif

                <div class="clearfix"></div>

                <!--CREDIT CART PAYMENT END-->
            </div>
        </form>
    </div>
</div>


@endsection
