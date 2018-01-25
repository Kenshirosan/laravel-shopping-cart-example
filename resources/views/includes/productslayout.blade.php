<div class="col-md-4">
    <div class="thumbnail">
        <div class="caption text-center">
            <strong>{{ $product->name }}</strong>
            <a href="{{ url('shop', [$product->slug]) }}">
                <img src="{{ asset('img/' . $product->image) }}" alt="product" class="img-responsive product-layout-img">
            </a>
            <a href="{{ url('shop', [$product->slug]) }}"><h3>{{ $product->name }}</h3>
                <p>${{ $product->price() }}</p>
            </a>
            @if( !Auth::guest() && Auth::user()->theboss )
                <form method="POST" action="/delete/{{$product->slug}}/product">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" name="submit" class="btn btn-danger">Delete</button>
                </form>
            @endif
        </div> <!-- end caption -->
    </div> <!-- end thumbnail -->
    <h3>${{ $product->price() }}</h3>

    <form action="{{ url('/cart') }}" method="POST" class="side-by-side" id="form">
        {{ csrf_field() }}

        <noscript>
            <input type="hidden" name="id"  value="{{ $product->id }}">
            <input type="hidden" name="name"  value="{{ $product->name }}">
            <input type="hidden" name="price"  value="{{ $product->price }}">

            @if( ! $product->options()->isEmpty() )
                 <select name="option" class="options minimal" v-model="selected" autofocus required>
                    <option value="" class="reset">Choose</option>
                @foreach($product->options() as $option)
                    <option class="option" value="{{ $option->name }}">{{ $option->name }}</option>
                @endforeach
                </select>
            @endif
            <input type="submit"  value="Add To Cart" class="btn btn-success">
        </noscript>

        <add-to-cart
            :product="{{ $product }}"
            @if( ! $product->options()->isEmpty() )
                :options="{{ $product->options() }}"
            @endif
        >
        </add-to-cart>
    </form>

    <div class="spacer"></div>
</div> <!-- end col-md-3 -->