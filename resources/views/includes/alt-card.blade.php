<article class="menu-item" data-category="{{ $category->name  }}">
    @if($product->is_on_sale)
        <div class="alternate-sales">
            <h2>{{ $product->getSalesPercentage() }}% Off!
                <span><small><strike>${{ $product->regularPrice() }}</strike></small>{{ $product->price() }}</span>
            </h2>
        </div>
    @endif
    <img src="/img/{{  $product->image }}"
         alt="Picture of {{ $product->name }}"
         class="photo">
    <div class="item-info">
        <header>
            <h4>{{ $product->name }}</h4>
            @if(!$product->is_on_sale)
                <h4 class="price">{{ $product->price()  }}</h4>
            @endif
        </header>
        <p class="item-text">
            {{ $product->description }}
        </p>
        @if(!$product->isEightySix())
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
        <div class="cart-btn-container">
            @if($product->isEightySix())
                <img class="alt-img-sold-out" src="/images/sold_out_stamp_cropped.jpg" alt="Product sold out !">
            @endif
        </div>
    </div>
    <div role="separator"></div>
    <div class="cart-btn-container">
        <favorite class="cart-btn" :product="{{ $product }}"></favorite>
        @if($_SERVER['REQUEST_URI'] != "/shop/$product->slug")
            <a class="cart-btn" href="/shop/{{ $product->slug }}">Voir</a>
        @endif
    </div>
    @can('see-admin-menu')
        <form method="POST" action="/delete/{{ $product->slug }}/product" class="deleteForm">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" name="submit" class="btn red danger deleteButton">Delete</button>
        </form>
        <a href="/update/{{ $product->slug }}" class="btn blue product-layout-img">Edit product</a>
        <mark-as-today-special :todayspecial="{{ $product->isTodaySpecial  }}" :product="{{ $product->id }}"></mark-as-today-special>
    @endcan
</article>
