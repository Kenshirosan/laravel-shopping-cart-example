@extends('layouts.master')

@section('content')
    <div class="container">
        @if( Auth::guest() )
            <div class="row">
                <div class="panel-body">

                    <form class="form-horizontal" method="POST" action="/register">
                        {{ csrf_field() }}

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

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <div class="col-md-12"><strong>Email Address:</strong></div>
                                    <div class="col-md-12">
                                        <input
                                            id="email"
                                            type="email"
                                            name="email"
                                            class="form-control"
                                            value="{{ old('email') }}" placeholder="Your Email" required/>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <div class="col-md-12"><strong>Password:</strong></div>
                                    <div class="col-md-12">
                                        <input
                                            type="password"
                                            name="password"
                                            class="form-control"
                                            value="{{ old('password')}}"
                                            placeholder="Your Password" required/></div>
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
                                        <input type="submit" value ="Register" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    @else
        <h1>You're already registered and logged in {{ Auth::user()->name }} !</h1>
    @endif
</div>
@endsection
