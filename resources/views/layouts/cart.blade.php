@extends('layouts.master')

@section('title')
    Cart
@endsection

@section('content')
    <p>
        <a href="{{ url('shop') }}">Home</a> / Cart
    </p>
    <h1 class="cyan-text center">Your Cart</h1>
    <div class="container mb-100">
    <hr>
        @if (sizeof(Cart::content()) > 0)
            <table class="striped highlight responsive-table">
                <thead>
                    <tr>
                        <th class="table-image">Image</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th class="column-spacer"></th>
                        <th>Action</th>
                    </tr>
                </thead>
            <tbody>
                @foreach (Cart::content() as $item)
                    <tr>
                        <td class="table-image">
                            <a href="{{ url('shop', [$item->model->slug]) }}"><img src="{{ asset('img/' . $item->model->image) }}" alt="product" class="img-responsive cart-image"></a>
                        </td>
                        <td>
                            <a href="{{ url('shop', [$item->model->slug]) }}">{{ $item->name }} {{ regex($item->options) }}</a>
                        </td>
                        <td>
                            <form action="/cart/{{ $item->rowId}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <select class="black-text quantity minimal" data-id="{{ $item->rowId }}">
                                    <option value="" disabled>Choose Your quantity</option>
                                    <option {{ $item->qty == 1 ? 'selected' : '' }}>1</option>
                                    <option {{ $item->qty == 2 ? 'selected' : '' }}>2</option>
                                    <option {{ $item->qty == 3 ? 'selected' : '' }}>3</option>
                                    <option {{ $item->qty == 4 ? 'selected' : '' }}>4</option>
                                    <option {{ $item->qty == 5 ? 'selected' : '' }}>5</option>
                                    <option {{ $item->qty == 6 ? 'selected' : '' }}>6</option>
                                </select>
                                <input type="hidden" name="quantity" value="{{$item->qty + 1}}">
                                <input type="submit" name="submit" value="Add 1" class="btn green btn-small">
                            </form>
                            <form action="/cart/{{ $item->rowId}}" method="POST" class="side-by-side">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <input type="hidden" name="quantity" value="{{$item->qty - 1}}">
                                <input type="submit" name="submit" value="Remove 1" class="btn red btn-small">
                            </form>
                        </td>
                        <td>${{ $item->subtotal /100 }}</td>
                        <td class=""></td>
                        <td>
                            <form action="/cart/{{ $item->rowId}}" method="POST" class="side-by-side">
                                {{ csrf_field() }}
                                {{ method_field('DELETE')}}
                                <input type="submit" class="btn red btn-small" value="Remove">
                            </form>
                            {{-- <form action="{{ url('switchToWishlist', [$item->rowId]) }}" method="POST" class="side-by-side">
                            {!! csrf_field() !!}
                                <input type="submit" class="btn btn-success btn-sm" value="To Wishlist">
                            </form> --}}
                        </td>
                    </tr>
                @endforeach
                    <tr>
                        <td class="table-image"></td>
                        <td></td>
                        <td class="small-caps table-bg right">Subtotal</td>
                        <td>${{ Cart::subtotal() /100 }}</td>
                    </tr>
                    <tr>
                        <td class="table-image"></td>
                        <td></td>
                        <td class="small-caps table-bg right">Tax</td>
                        <td>${{ Cart::tax() /100 }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <td class="table-image"></td>
                        <td style="padding: 40px;"></td>
                        <td class="right">Your Total</td>
                        <td>${{ Cart::total() /100 }}</td>
                        <td class="column-spacer"></td>
                    </tr>
                </tbody>
            </table>
            <a href="{{ url('/shop') }}" class="btn btn-small blue scale_when_hover">Continue Shopping</a> &nbsp;
            <a href="/checkout" class="btn btn-small scale_when_hover">Proceed to Checkout</a>
            <div class="right">
                <form action="{{ url('/emptyCart') }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="submit" class="btn btn-small red scale_when_hover" value="Empty Cart">
                </form>
            </div>
        @else
            <h3>You have no items in your shopping cart</h3>
            <a href="{{ url('/shop') }}" class="btn btn-primary btn-lg">Continue Shopping</a>
        @endif
    </div>

@endsection

@section('update-cart')
    @include('javascript.updateCart')
@endsection