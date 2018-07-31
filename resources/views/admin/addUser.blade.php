@extends('adminlte::page')

@section('title')
    Add a user
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel-body">

                <form class="form-horizontal" method="POST" action="/add-user">
                    {{ csrf_field() }}
                    <!--SHIPPING METHOD-->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Register
                        </div>
                        <div class="panel-body">

                            <div class="form-group">
                                <div class="col-md-12">
                                    <h4>All fields are mandatory</h4>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <strong>First Name:</strong>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="First Name" required/>
                                </div>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <div class="span1"></div>
                                <div class="col-md-12">
                                    <strong>Last Name:</strong>
                                    <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" placeholder="Last Name" required/>
                                </div>
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                <div class="col-md-12"><strong>Phone Number:</strong></div>
                                <div class="col-md-12"><input type="text" name="phone_number" class="form-control" value="{{ old('phone_number') }}" placeholder="Phone Number" required/>
                                </div>
                                @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="col-md-12"><strong>Email Address:</strong></div>
                                <div class="col-md-12"><input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email" required/></div>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="col-md-12"><strong>Password:</strong></div>
                                <div class="col-md-12"><input type="password" name="password" class="form-control" value="{{ old('password')}}" placeholder="Password" required/></div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="col-md-12"><strong>Confirm Password:</strong></div>

                                <div class="col-md-12">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Password Confirmation" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="submit" value="Add Employee" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection