@extends('layouts.master')

@section('title')
    {{ $product->name }}
@endsection

@section('content')


    <h1>{{ $product->name }}</h1>

    <hr>

    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset('img/' . $product->image) }}" alt="product" class="img-responsive">
            @foreach( $product->photos as $item)
                <img src="{{ asset($item->photos) }}" alt="{{ $product->name }}" class="img-responsive">

            @endforeach
        </div>

        <div class="col-md-8">
            <h3>${{ $product->price /100 }}</h3>
            <form action="{{ url('/cart') }}" method="POST" class="side-by-side">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $product->id }}">
                <input type="hidden" name="name" value="{{ $product->name }}">
                <input type="hidden" name="price" value="{{ $product->price }}">
                <input type="submit" class="btn btn-success btn-lg" value="Add to Cart">
            </form>

            @if( !Auth::guest() && Auth::user()->isAdmin() )
                <form id="addPhotosForm" class="dropzone" action="/shop/{{ $product->slug }}/photo" enctype="multipart/form-data" method="POST">
                    {{ csrf_field() }}
                </form>
            @endif
            <br><br>

            {{ $product->description }}
        </div> <!-- end col-md-8 -->
    </div> <!-- end row -->

    <div class="spacer"></div>

    <p><a class="btn btn-primary" href="{{ url('/shop') }}">Back to menu</a></p>
    <div class="spacer"></div>

@endsection

@section('dropzone.script')
    <script src="/js/dropzone.min.js" charset="utf-8"></script>
    <script>
    Dropzone.options.addPhotosForm = {
        paramName: 'photos',
        maxFilesize: 4,
        acceptedFiles: '.jpg, .jpeg, .png, .bmp'
    };
    </script>
@endsection
