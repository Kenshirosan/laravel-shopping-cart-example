<div class="col-md-3">
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
            <favorite :product="{{ $product }}"></favorite>
            @can('see-admin-menu')
                <form method="POST" action="/delete/{{$product->slug}}/product" class="deleteForm">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" name="submit" class="btn btn-danger deleteButton">Delete</button>
                </form>
                <a href="/update/{{ $product->slug }}" class="btn btn-info product-layout-img">Update</a>
            @endcan
        </div> <!-- end caption -->
    </div> <!-- end thumbnail -->

    <h3>${{ $product->price() }}</h3>
    @if( $product->is_eighty_six() )
        <img src="/images/sold_out_stamp_cropped.jpg" alt="Product sold out !" class="img-responsive">
    @else
        <add-to-cart
            :product="{{ $product }}"
            @if( $product->group )
                :options="{{ $product->options() }}"
            @endif
            @if( $product->secondGroup )
                :secondoptions="{{ $product->secondOptions() }}"
            @endif
        >
        </add-to-cart>

    @endif
    <div class="mb-100"></div>
</div> <!-- end col-md-3 -->