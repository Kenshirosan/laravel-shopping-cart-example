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