@extends('layouts.master')

@section('title')
    {{ $product->name }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <h1 class="blue-text center">{{ $product->name }}</h1>
            <div class="col">
                @include('includes.card')
            </div>
            <div class="col s12 m4">
                <img
                    src="/img/{{ $product->image }}"
                    alt="{{ $product->name }}"
                    width="50%"
                    class="materialboxed">
                @foreach( $product->photos as $item)
                    <img
                        src="{{ asset($item->photos) }}"
                        alt="{{ $product->name }}"
                        width="50%"
                        class="lity-img materialboxed">
                @endforeach
            </div>
        </div>
        @if( Auth::check() && Auth::user()->isAdmin() )
            <form id="addPhotosForm" class="dropzone" action="/shop/{{ $product->slug }}/photo" enctype="multipart/form-data" method="POST">
                {{ csrf_field() }}
            </form>
        @endif
        <p><a class="btn waves-effect waves-green indigo" href="{{ url('/shop') }}">Back to menu</a></p>
    </div>

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