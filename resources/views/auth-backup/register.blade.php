@extends('layouts.master')

@section('content')
    <div class="container">
        @if( Auth::guest() )
            <div class="row">
                <form  method="POST" action="/register">
                    {{ csrf_field() }}
                    <div class="col s12">
                        <h4>All fields are mandatory</h4>
                    </div>

                    <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                class="black-text validate"
                                value="{{ old('email') }}" required>
                            <label for="email">Email Address:</label>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">vpn_key</i>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                class="black-text validate"
                                value="{{ old('password')}}"
                                required>
                            <label for="password">Password:</label>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="input-field col s12">
                        <i class="material-icons prefix">vpn_key</i>
                        <input
                            id="password_confirmation"
                            type="password"
                            class="black-text validate"
                            name="password_confirmation"
                            required>
                        <label for="password_confirmation">Confirm Password</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="submit" value ="Register" class="btn btn-primary">
                    </div>
                </form>
            </div>
    @else
        <h1>You're already registered and logged in {{ Auth::user()->name }} !</h1>
    @endif
</div>
@endsection
