@extends('layouts.master')

@section('title')
    Our Daily Specials
@endsection

@section('content')
    <div class="jumbotron text-center clearfix">
        <h2>Name of your restaurant</h2>
        <p>Place your order !</p>

    </div> <!-- end jumbotron -->



    @foreach ($dailys->chunk(4) as $items)
        <div class="response"></div>
        <a href="{{ url('/cart') }}" class="btn btn-info pull-right">Go to cart</a>
        <div class="row">
            <h1>Daily Specials</h1>
            @foreach ($items as $product)
                <div class="col-md-3">
                    <div class="thumbnail">
                        <div class="caption text-center">
                            {{ $product->name }}
                            <a href="/special/{{ $product->slug }}"><img src="{{ asset('img/' . $product->image) }}" alt="product" class="img-responsive"></a>
                            <a href="/special/{{ $product->slug }}"><h3>{{ $product->name }}</h3>
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
    

</div> <!-- end row -->

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
