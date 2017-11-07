<div class="col-md-3">
    <div class="thumbnail">
        <div class="caption text-center">
            {{ $product->name }}
            <a href="{{ url('shop', [$product->slug]) }}">
                <img src="{{ asset('img/' . $product->image) }}" alt="product" class="img-responsive">
            </a>
            <a href="{{ url('shop', [$product->slug]) }}"><h3>{{ $product->name }}</h3>
                <p>{{ $product->price /100 }}</p>
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
    <h3>${{ $product->price / 100}}</h3>

    <form action="{{ url('/cart') }}" method="POST" class="side-by-side" id="form">
        {{ csrf_field() }}
        {{-- form for my super not working with options vue component --}}
        <input type="hidden" name="id" v-model="this.id" value="{{ $product->id }}">
        <input type="hidden" name="name" v-model="this.name" value="{{ $product->name }}">
        <input type="hidden" name="price" v-model="this.price" value="{{ $product->price }}">
        {{-- noscript --}}
        <input type="hidden" name="id"  value="{{ $product->id }}">
        <input type="hidden" name="name"  value="{{ $product->name }}">
        <input type="hidden" name="price"  value="{{ $product->price }}">

        @if( ! $product->options()->isEmpty() )
             <select name="options" class="options minimal" v-model="selected" autofocus required>
                <option value="" class="reset">Choose</option>
            @foreach($product->options() as $option)
                <option class="option" value="{{ $option->name }}">{{ $option->name }}</option>
            @endforeach
            </select>
        @endif
            {{-- <addToCart :product="{{ $product }}" :selected="selected"></addToCart> --}}

        {{-- <noscript> --}}
            <input type="submit"  value="Add To Cart" class="btn btn-success">
        {{-- </noscript> --}}
    </form>

    <div class="spacer"></div>
</div> <!-- end col-md-3 -->