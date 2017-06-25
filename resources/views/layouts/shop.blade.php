@extends('layouts.master')

@section('content')

    <div class="container">

        @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if (session()->has('error_message'))
            <div class="alert alert-danger">
                {{ session()->get('error_message') }}
            </div>
        @endif

        <div class="jumbotron text-center clearfix">
            <h2>Name of your restaurant</h2>
            <p>Place your order !</p>
        </div> <!-- end jumbotron -->


        {{--  Appetizers --}}
        @foreach ($appetizers->chunk(4) as $items)
            <div class="row">
                <h1>Appetizers</h1>
                @foreach ($items as $product)
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <div class="caption text-center">
                                {{$product->name}}
                                <a href="{{ url('shop', [$product->slug]) }}"><img src="{{ asset('img/' . $product->image) }}" alt="product" class="img-responsive"></a>
                                <a href="{{ url('shop', [$product->slug]) }}"><h3>{{ $product->name }}</h3>
                                    <p>{{ $product->price }}</p>
                                </a>
                                @if( !Auth::guest() && Auth::user()->theboss )
                                    <a href="{{ route('/delete', ['slug' => $product->slug]) }}" class="btn btn-danger">Delete</a>
                                @endif
                            </div> <!-- end caption -->
                        </div> <!-- end thumbnail -->
                        <h3>${{ $product->price }}</h3>

                        <form action="{{ url('/cart') }}" method="POST" class="side-by-side" id="{{$product->slug}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="name" value="{{ $product->name }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <button name ="submit" class="btn btn-success btn-lg">Add to Cart</button>
                        </form>

                        <div class="spacer"></div>
                    </div> <!-- end col-md-3 -->
                @endforeach
            </div> <!-- end row -->
        @endforeach

        {{--  Main --}}
        @foreach ($main->chunk(4) as $items)
            <div class="row">
                <h1>Meat and Fish</h1>
                @foreach ($items as $product)
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <div class="caption text-center">
                                {{$product->name}}
                                <a href="{{ url('shop', [$product->slug]) }}"><img src="{{ asset('img/' . $product->image) }}" alt="product" class="img-responsive"></a>
                                <a href="{{ url('shop', [$product->slug]) }}"><h3>{{ $product->name }}</h3>
                                    <p>{{ $product->price }}</p>
                                </a>
                                @if( !Auth::guest() && Auth::user()->theboss )
                                    <a href="{{ route('/delete', ['slug' => $product->slug]) }}" class="btn btn-danger">Delete</a>
                                @endif
                            </div> <!-- end caption -->
                        </div> <!-- end thumbnail -->
                        <h3>${{ $product->price }}</h3>
                        <form action="{{ url('/cart') }}" method="POST" class="side-by-side">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="name" value="{{ $product->name }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <input type="submit" class="btn btn-success btn-lg addToCart" id="{{ $product->id }}" value="Add to Cart">
                        </form>
                        <div class="spacer"></div>
                    </div> <!-- end col-md-3 -->
                @endforeach
            </div> <!-- end row -->
        @endforeach

        {{--  Burgers and sandwiches --}}
        @foreach ($burgers->chunk(4) as $items)
            <div class="row">
                <h1>Burgers and sandwiches</h1>
                @foreach ($items as $product)
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <div class="caption text-center">
                                {{$product->name}}
                                <a href="{{ url('shop', [$product->slug]) }}"><img src="{{ asset('img/' . $product->image) }}" alt="product" class="img-responsive"></a>
                                <a href="{{ url('shop', [$product->slug]) }}"><h3>{{ $product->name }}</h3>
                                    <p>{{ $product->price }}</p>
                                </a>
                                @if( !Auth::guest() && Auth::user()->theboss )
                                    <a href="{{ route('/delete', ['slug' => $product->slug]) }}" class="btn btn-danger">Delete</a>
                                @endif
                            </div> <!-- end caption -->
                        </div> <!-- end thumbnail -->
                        <h3>${{ $product->price }}</h3>
                        <form action="{{ url('/cart') }}" method="POST" class="side-by-side">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="name" value="{{ $product->name }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <input type="submit" class="btn btn-success btn-lg addToCart" id="{{ $product->id }}" value="Add to Cart">
                        </form>
                        <div class="spacer"></div>
                    </div> <!-- end col-md-3 -->
                @endforeach
            </div> <!-- end row -->
        @endforeach

        {{--  Desserts --}}
        @foreach ($dessert->chunk(4) as $items)
            <div class="row">
                <h1>Desserts</h1>
                @foreach ($items as $product)
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <div class="caption text-center">
                                {{$product->name}}
                                <a href="{{ url('shop', [$product->slug]) }}"><img src="{{ asset('img/' . $product->image) }}" alt="product" class="img-responsive"></a>
                                <a href="{{ url('shop', [$product->slug]) }}"><h3>{{ $product->name }}</h3>
                                    <p>{{ $product->price }}</p>
                                </a>
                                @if( !Auth::guest() && Auth::user()->theboss )
                                    <a href="{{ route('/delete', ['slug' => $product->slug]) }}" class="btn btn-danger">Delete</a>
                                @endif
                            </div> <!-- end caption -->
                        </div> <!-- end thumbnail -->
                        <h3>${{ $product->price }}</h3>
                        <form action="{{ url('/cart') }}" method="POST" class="side-by-side">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="name" value="{{ $product->name }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <input type="submit" class="btn btn-success btn-lg addToCart" id="{{ $product->id }}" value="Add to Cart">
                        </form>
                        <div class="spacer"></div>
                    </div> <!-- end col-md-3 -->
                @endforeach
            </div> <!-- end row -->
        @endforeach

        {{--  Drinks --}}
        @foreach ($drinks->chunk(4) as $items)
            <div class="row">
                <h1>Drinks</h1>
                @foreach ($items as $product)
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <div class="caption text-center">
                                {{$product->name}}
                                <a href="{{ url('shop', [$product->slug]) }}"><img src="{{ asset('img/' . $product->image) }}" alt="product" class="img-responsive"></a>
                                <a href="{{ url('shop', [$product->slug]) }}"><h3>{{ $product->name }}</h3>
                                    <p>{{ $product->price }}</p>
                                </a>
                                @if( !Auth::guest() && Auth::user()->theboss )
                                    <a href="{{ route('/delete', ['slug' => $product->slug]) }}" class="btn btn-danger">Delete</a>
                                @endif
                            </div> <!-- end caption -->
                        </div> <!-- end thumbnail -->
                        <h3>${{ $product->price }}</h3>
                        <form action="{{ url('/cart') }}" method="POST" class="side-by-side">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="name" value="{{ $product->name }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <input type="submit" class="btn btn-success btn-lg addToCart" id="{{ $product->id }}" value="Add to Cart">
                        </form>
                        <div class="spacer"></div>
                    </div> <!-- end col-md-3 -->
                @endforeach
            </div> <!-- end row -->
        @endforeach
    </div> <!-- end container -->
@endsection

@section('ajax')
    <script>

    $(document).ready( function() {
        //
        //     //quand mon formulaire est envoyé
        $('#{{$product->slug}}').submit(function(event){
            event.preventDefault();
            //
            //AJAX !!
            $.post('{{url('/cart')}}', $('#{{$product->slug}}').serialize(), function() {

                $('#{{$product->slug}}').append('your order has been placed');
                console.log($('#{{$product->slug}}'));

            });
            // $('#{{ $product->slug }}').trigger('reset');
            return false; // change pas de main !
        });
    });
    </script>
@endsection
