@extends('layouts.master')

@section('title')
    Shop with us
@endsection

@section('content')

        <div class="jumbotron text-center clearfix">
            <h2>Name of your restaurant</h2>
            <p>Place your order !</p>

        </div> <!-- end jumbotron -->


        {{--  Appetizers --}}
        @foreach ($appetizers->chunk(4) as $items)
            <div class="response"></div>
            <a href="{{ url('/cart') }}" class="btn btn-info pull-right">Go to cart</a>
            <div class="row">
                <h1>Appetizers</h1>
                @foreach ($items as $product)
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <div class="caption text-center">
                                {{ $product->name }}
                                <a href="{{ url('shop', [$product->slug]) }}"><img src="{{ asset('img/' . $product->image) }}" alt="product" class="img-responsive"></a>
                                <a href="{{ url('shop', [$product->slug]) }}"><h3>{{ $product->name }}</h3>
                                    <p>{{ $product->price /100 }}</p>
                                </a>
                                @if( !Auth::guest() && Auth::user()->theboss )
                                    <a href="{{ route('/delete', ['slug' => $product->slug]) }}" class="btn btn-danger">Delete</a>
                                @endif
                            </div> <!-- end caption -->
                        </div> <!-- end thumbnail -->
                        <h3>${{ $product->price / 100}}</h3>

                        <form action="{{ url('/cart') }}" method="POST" class="side-by-side">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $product->id }}" >
                            <input type="hidden" name="name" value="{{ $product->name }}">
                            <input type="hidden" name="price" value="{{ $product->price }}" >
                            <button name ="submit" class="btn btn-success btn-lg add_to_cart" data-id="{{ $product->id }}"  data-name="{{ $product->name }}" data-price="{{ $product->price }}">Add to Cart</button>
                        </form>

                        <div class="spacer"></div>
                    </div> <!-- end col-md-3 -->
                @endforeach
            </div> <!-- end row -->
        @endforeach

        {{--  Main --}}
        @foreach ($main->chunk(4) as $items)
            <div class="response"></div>
            <a href="{{ url('/cart') }}" class="btn btn-info pull-right">Go to cart</a>
            <div class="row">
                <h1>Meat and Fish</h1>
                @foreach ($items as $product)
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <div class="caption text-center">
                                {{$product->name}}
                                <a href="{{ url('shop', [$product->slug]) }}"><img src="{{ asset('img/' . $product->image) }}" alt="product" class="img-responsive"></a>
                                <a href="{{ url('shop', [$product->slug]) }}"><h3>{{ $product->name }}</h3>
                                    <p>{{ $product->price / 100 }}</p>
                                </a>
                                @if( !Auth::guest() && Auth::user()->theboss )
                                    <a href="{{ route('/delete', ['slug' => $product->slug]) }}" class="btn btn-danger">Delete</a>
                                @endif
                            </div> <!-- end caption -->
                        </div> <!-- end thumbnail -->
                        <h3>${{ $product->price / 100 }}</h3>
                        <form action="{{ url('/cart') }}" method="POST" class="side-by-side">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="name" value="{{ $product->name }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <button name ="submit" class="btn btn-success btn-lg add_to_cart" data-id="{{ $product->id }}"  data-name="{{ $product->name }}" data-price="{{ $product->price }}">Add to Cart</button>
                        </form>
                        <div class="spacer"></div>
                    </div> <!-- end col-md-3 -->
                @endforeach
            </div> <!-- end row -->
        @endforeach

        {{--  Burgers and sandwiches --}}
        @foreach ($burgers->chunk(4) as $items)
            <div class="response"></div>
            <a href="{{ url('/cart') }}" class="btn btn-info pull-right">Go to cart</a>
            <div class="row">
                <h1>Burgers and sandwiches</h1>
                @foreach ($items as $product)
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <div class="caption text-center">
                                {{$product->name}}
                                <a href="{{ url('shop', [$product->slug]) }}"><img src="{{ asset('img/' . $product->image) }}" alt="product" class="img-responsive"></a>
                                <a href="{{ url('shop', [$product->slug]) }}"><h3>{{ $product->name }}</h3>
                                    <p>{{ $product->price /100 }}</p>
                                </a>
                                @if( !Auth::guest() && Auth::user()->theboss )
                                    <a href="{{ route('/delete', ['slug' => $product->slug]) }}" class="btn btn-danger">Delete</a>
                                @endif
                            </div> <!-- end caption -->
                        </div> <!-- end thumbnail -->
                        <h3>${{ $product->price /100 }}</h3>
                        <form action="{{ url('/cart') }}" method="POST" class="side-by-side">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="name" value="{{ $product->name }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <button name ="submit" class="btn btn-success btn-lg add_to_cart" data-id="{{ $product->id }}"  data-name="{{ $product->name }}" data-price="{{ $product->price }}">Add to Cart</button>
                        </form>
                        <div class="spacer"></div>
                    </div> <!-- end col-md-3 -->
                @endforeach
            </div> <!-- end row -->
        @endforeach

        {{--  Desserts --}}
        @foreach ($dessert->chunk(4) as $items)
            <div class="response"></div>
            <a href="{{ url('/cart') }}" class="btn btn-info pull-right">Go to cart</a>
            <div class="row">
                <h1>Desserts</h1>
                @foreach ($items as $product)
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <div class="caption text-center">
                                {{$product->name}}
                                <a href="{{ url('shop', [$product->slug]) }}"><img src="{{ asset('img/' . $product->image) }}" alt="product" class="img-responsive"></a>
                                <a href="{{ url('shop', [$product->slug]) }}"><h3>{{ $product->name }}</h3>
                                    <p>{{ $product->price /100 }}</p>
                                </a>
                                @if( !Auth::guest() && Auth::user()->theboss )
                                    <a href="{{ route('/delete', ['slug' => $product->slug]) }}" class="btn btn-danger">Delete</a>
                                @endif
                            </div> <!-- end caption -->
                        </div> <!-- end thumbnail -->
                        <h3>${{ $product->price /100 }}</h3>
                        <form action="{{ url('/cart') }}" method="POST" class="side-by-side">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="name" value="{{ $product->name }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <button name ="submit" class="btn btn-success btn-lg add_to_cart" data-id="{{ $product->id }}"  data-name="{{ $product->name }}" data-price="{{ $product->price }}">Add to Cart</button>
                        </form>
                        <div class="spacer"></div>
                    </div> <!-- end col-md-3 -->
                @endforeach
            </div> <!-- end row -->
        @endforeach

        {{--  Drinks --}}
        @foreach ($drinks->chunk(4) as $items)
            <div class="response"></div>
            <a href="{{ url('/cart') }}" class="btn btn-info pull-right">Go to cart</a>

            <div class="row">
                <h1>Drinks</h1>
                @foreach ($items as $product)
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <div class="caption text-center">
                                {{$product->name}}
                                <a href="{{ url('shop', [$product->slug]) }}"><img src="{{ asset('img/' . $product->image) }}" alt="product" class="img-responsive"></a>
                                <a href="{{ url('shop', [$product->slug]) }}"><h3>{{ $product->name }}</h3>
                                    <p>{{ $product->price /100 }}</p>
                                </a>
                                @if( !Auth::guest() && Auth::user()->theboss )
                                    <a href="{{ route('/delete', ['slug' => $product->slug]) }}" class="btn btn-danger">Delete</a>
                                @endif
                            </div> <!-- end caption -->
                        </div> <!-- end thumbnail -->
                        <h3>${{ $product->price /100 }}</h3>
                        <form action="{{ url('/cart') }}" method="POST" class="side-by-side">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="name" value="{{ $product->name }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <button name ="submit" class="btn btn-success btn-lg add_to_cart" data-id="{{ $product->id }}"  data-name="{{ $product->name }}" data-price="{{ $product->price }}">Add to Cart</button>
                        </form>
                        <div class="spacer"></div>

                    </div> <!-- end col-md-3 -->
                @endforeach

            </div> <!-- end row -->
        @endforeach
        <div class="container text-center">
            <a href="#top" class="btn btn-info">Back to top</a>
        </div>


@endsection

@section('ajax')
    <script>
    $(document).ready( function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.add_to_cart').click(function(){
            var product_id = $(this).data('id');
            var product_name = $(this).data('name');
            var product_price = $(this).data('price');
            $.ajax({
                url: '{{ url('/cart') }}',
                method: 'POST',
                data: {
                    id:product_id,
                    name:product_name,
                    price:product_price
                },
                success: function(data){
                    $('.response').append('<p class=\'alert alert-info\'>' + product_name + ' was added to cart !</p>');
                }
            });
            return false;
        });
    });
    </script>
@endsection