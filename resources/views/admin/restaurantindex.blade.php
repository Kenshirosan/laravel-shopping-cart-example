@extends('layouts.master')

@section('content')
    @if( (Auth::user()->theboss) || (Auth::user()->employee) )
        @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if (session()->has('error_message'))
            <div class="alert alert-danger">
                {{ session()->get('error_message') }}
            </div>
        @endif
        <div class="container">
            <h1>Hello, {{ Auth::user()->name }}</h1>
            <form class="form-horizontal" method="POST" action="/insertproduct" enctype="multipart/form-data">
                {{ csrf_field() }}

                {{--  NAME OF MEAL --}}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Name of Meal</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus required>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{--  CATEGORY --}}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Category</label>

                    <div class="col-md-6">
                        <select id="category" class="form-control" name="category" value="{{ old('category') }}" autofocus required>
                            <option value="Appetizers">Appetizers</option>
                            <option value="Burgers and sandwiches">Burgers and sandwiches</option>
                            <option value="Main">Main</option>
                            <option value="Dessert">Dessert</option>
                            <option value="Drinks">Drinks</option>
                            @if ($errors->has('category'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('category') }}</strong>
                                </span>
                            @endif
                        </select>
                        </div>
                    </div>

                    {{--  SLUG --}}
                    <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                        <label for="slug" class="col-md-4 control-label">Slug (ex: name-of-meal)</label>

                        <div class="col-md-6">
                            <input id="slug" type="text" class="form-control" name="slug" value="{{ old('slug') }}" required>

                            @if ($errors->has('slug'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('slug') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    {{--  DESCRIPTION --}}
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description" class="col-md-4 control-label">Description</label>

                        <div class="col-md-6">
                            <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required>

                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    {{--  PRICE --}}
                    <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                        <label for="price" class="col-md-4 control-label">Price</label>

                        <div class="col-md-6">
                            <input id="price" type="number" step="any" class="form-control" name="price" value="{{ old('price') }}" required>

                            @if ($errors->has('price'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    {{--  IMAGE --}}
                    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                        <label for="image" class="col-md-4 control-label">Image</label>

                        <div class="col-md-6">
                            <input id="image" type="file" accept="image/png, image/jpg"  class="form-control" name="image" value="{{ old('image') }}" required>
                            @if ($errors->has('image'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <input type=submit value='Submit'class="btn btn-primary">
                        </div>
                    </div>
                </form>



                <form class="form-horizontal" method="get" action="/logout">
                    @include('layouts.error')
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type=submit value='logout' class="btn btn-danger">
                        </div>
                    </div>
                </form>
            </div>

            <div class="container">

                <ul class=list-group>
                    @if(Auth::user()->theboss)
                        <li class="list-group-item"><a href="/panel" class="btn btn-primary">View all</a></li>
                        @foreach( $orders as $order )
                            <li class="list-group-item"><h4>Latest Orders: {{ $order->id }}</h4>{{ $order->name }} {{ $order->last_name }} paid $<strong>{{ $order->price }}</strong> for {{ $order->items }} on <strong>{{ $order->created_at->toFormattedDateString() }}</strong> at {{    $order->created_at->toTimeString() }}</li>
                        @endforeach
                    @endif

                </ul>
            </div>
        @elseif( (!Auth::user()->theboss) || (!Auth::user()->employee) )

            <script type="text/javascript">
            window.location = "{{ url('/shop') }}";
            </script>
        @endif
        <div class="spacer"></div>
    @endsection
