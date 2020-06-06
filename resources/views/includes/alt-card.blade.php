<article class="menu-item" data-category="{{ $category->name  }}">
    <img src="/img/{{  $product->image }}"
         alt=""
         class="photo">
    <div class="item-info">
        <header>
            <h4>{{ $product->name }}</h4>
            <h4 class="price">{{ $product->price()  }}</h4>
        </header>
        <p class="item-text">
            {{ $product->description }}
        </p>
        @if(!$product->is_eighty_six())
{{--            <img class="activator sold-out right" src="/images/sold_out_stamp_cropped.jpg" alt="Product sold out !">--}}
{{--        @else--}}
            <add-to-cart
                    :product="{{ $product }}"
                    @if( $product->groups )
                    :options="{{ $product->groups }}"
                    @endif
                    @if( $product->getWaysOfCooking() )
                    :waysOfCooking="{{ $product->getWaysOfCooking() }}"
                    @endif
            >
            </add-to-cart>
        @endif
{{--        <favorite class="ml-20 mt-15" :product="{{ $product }}"></favorite>--}}
{{--        @if($_SERVER['REQUEST_URI'] != "/shop/$product->slug")--}}
{{--            <a class="btn-small mt-15 cyan right" href="/shop/{{ $product->slug }}">Voir</a>--}}
{{--        @endif--}}
        <div class="cart-btn-container">
            @if($product->is_eighty_six())
                <img class="alt-img-sold-out" src="/images/sold_out_stamp_cropped.jpg" alt="Product sold out !">
            @endif
            <favorite class="cart-btn" :product="{{ $product }}"></favorite>
            @if($_SERVER['REQUEST_URI'] != "/shop/$product->slug")
                <a class="cart-btn" href="/shop/{{ $product->slug }}">Voir</a>
            @endif
        </div>
    </div>

    @can('see-admin-menu')
        <form method="POST" action="/delete/{{$product->slug}}/product" class="deleteForm">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" name="submit" class="btn red danger deleteButton">Delete</button>
        </form>
        <a href="/update/{{ $product->slug }}" class="btn blue product-layout-img">Update</a>
    @endcan
    @if($product->is_on_sale)
        <div class="alternate-sales">
            <h2>{{ $product->getSalesPercentage() }}% Off!
                <span><small>was ${{ $product->regularPrice() }}</small></span>
            </h2>
        </div>
    @endif
</article>
