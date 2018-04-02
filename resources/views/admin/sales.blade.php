@extends('adminlte::page')

@section('title')
        Create a sale
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel-body">

                <form class="form-horizontal" method="POST" action="/sales">
                    {{ csrf_field() }}
                    <!--SHIPPING METHOD-->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Add sale
                        </div>
                        <div class="panel-body">

                            <div class="form-group">
                                <div class="col-md-12">
                                    <h4>All fields are mandatory</h4>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('percentage') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <strong>Percentage</strong>
                                    <input type="number" name="percentage" class="form-control" value="{{ old('percentage') }}" placeholder="Percentage" required/>
                                </div>
                                @if ($errors->has('percentage'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('percentage') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <select name="product_id" class="options" required autofocus>
                                        <option value="" class="reset">Choose</option>
                                        @foreach($products as $product)
                                            @if( ! $product->is_on_sale)
                                                <option class="options" name="product" value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="submit" value ="Add Sale" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if($sales->isEmpty())
            <div class="row">
                <div class="container">
                    No product on sale.
                </div>
            </div>
        @else
            <div class="row">
                <div class="container">
                    @foreach($sales as $sale)
                    <div class="col-md-6">
                        <p>{{ $sale->product()->name }} has
                            <span class="text-info">{{ $sale->percentage * 100 }} % Off.<span>
                        </p>
                        <form action="/delete-sales/{{ $sale->id }}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-danger form-group deleteButton">Delete {{ $sale->product()->name }} sale</button>
                            </div>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection