@extends('adminlte::page')

@section('title')
    Create An Invoice
@endsection

@section('content')
    <div class="container">
        <form action="/create-invoice" method="POST" class="form-horizontal">
            {{ csrf_field() }}
         <div class="form-group">
                <div class="col-md-12">
                    <h4>Shipping Address</h4>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-xs-12">
                    <strong>First Name:</strong>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" />
                </div>
                <div class="span1"></div>
                <div class="col-md-6 col-xs-12">
                    <strong>Last Name:</strong>
                    <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" />
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                <p>
                    <strong>Address: </strong>
                </p>
                    <input type="text" name="address" class="form-control" value=" {{ old('address') }} " />
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12"><strong>Address 2:</strong></div>
                <div class="col-md-12">
                    <input type="text" name="address2" class="form-control" value="{{  old('address2') }}" />
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12"><strong>Zipcode:</strong></div>
                <div class="col-md-12">
                    <input type="number" class="form-control" name="zipcode">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12"><strong>Phone Number:</strong></div>
                <div class="col-md-12">
                    <input type="tel" name="phone_number" class="form-control" value="{{ old('phone_number') }}" />
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12"><strong>Email Address:</strong></div>
                <div class="col-md-12">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" />
                </div>
            </div>
            <div class="row">
                <div class="panel-body">
                    <select name="products[]" multiple style="color:white">
                                <option value="">Choose</option>
                        @foreach($products as $product)
                            <div class="col-md-2">
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            </div>
                        @endforeach
                    </select>
                </div>
                <input type="submit" class="btn btn-success" value="Submit">
            </div>
        </form>
    </div>
@endsection