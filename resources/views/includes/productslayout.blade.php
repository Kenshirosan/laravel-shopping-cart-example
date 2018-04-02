<div class="col-md-4">
    <div class="thumbnail">
        @if($product->is_on_sale)
            <div class="sales">
                <h2>{{ $product->sales->percentage  * 100 }}% Off!
                    <span><small>was ${{ $product->regularPrice() }}</small></span>
                </h2>
            </div>
        @endif
        <div class="caption text-center">
            <strong>{{ $product->name }}</strong>
            <a href="{{ url('shop', [$product->slug]) }}">
                <img src="{{ asset('img/' . $product->image) }}" alt="product" class="img-responsive product-layout-img">
            </a>
            <a href="{{ url('shop', [$product->slug]) }}"><h3>{{ $product->name }}</h3>
                <p>${{ $product->price() }}</p>
            </a>
            @if( Auth::check() && Auth::user()->theboss )
                <form method="POST" action="/delete/{{$product->slug}}/product" class="deleteForm">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" name="submit" class="btn btn-danger deleteButton">Delete</button>
                </form>
                <a href="/update/{{ $product->slug }}" class="btn btn-info product-layout-img">Update</a>
            @endif
        </div> <!-- end caption -->
    </div> <!-- end thumbnail -->

    <h3>${{ $product->price() }}</h3>

    {{-- <form action="{{ url('/cart') }}" method="POST" class="side-by-side" id="form">
        {{ csrf_field() }} --}}

        <add-to-cart
            :product="{{ $product }}"
            @if( ! $product->options()->isEmpty() )
                :options="{{ $product->options() }}"
            @endif
        >
        </add-to-cart>
    {{-- </form> --}}

    <div class="spacer"></div>
</div> <!-- end col-md-3 -->