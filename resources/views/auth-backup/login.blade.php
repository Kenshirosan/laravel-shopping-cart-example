@extends('layouts.master')
@section('content')

<div class="container">
    <div class="col s12">
        <h4>All fields are mandatory</h4>
    </div>
    <div class="row">
        @if ( Auth::guest() )
        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="input-field col s12">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="email" type="email" class="black-text" name="email" value="{{ old('email') }}" required autofocus>
                    <label for="email">E-Mail Address</label>
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
                    <input id="password" type="password" class="black-text" name="password" required>
                    <label for="password">Password</label>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
                <div class="input-field col s12">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span>Remember Me</span>
                        </label>
                    </div>
                </div>
                <div class="col s12">
                    <button type="submit" class="btn green">
                        Login
                    </button>
                    <a class="btn orange" href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>
                    or
                    <small><a class="btn blue" href="/register">Register</a></small>
                </div>
        </form>
    @else
        <h1 class="red-text center">You're already logged in !</h1>
    @endif
    </div>
</div>
@endsection
