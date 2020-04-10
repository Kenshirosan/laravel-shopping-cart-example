@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-content">
                <div class="card-title">Reset Password</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert green">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form role="form" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="{{ $errors->has('email') ? ' has-error' : '' }}">

                            <div class="input-field col s12">
                                <i class="material-icons prefix">email</i>
                                <input id="email" type="email" class="black-text" name="email" value="{{ $email or old('email') }}" required autofocus>
                                <label for="email">E-Mail Address</label>

                                @if ($errors->has('email'))
                                    <span class="help-block red white-text">
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
                                    <span class="help-block red white-text">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="{{ $errors->has('password_confirmation') ? ' has-error' : '' }} ">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">vpn_key</i>
                                <input id="password-confirm" type="password" class="black-text" name="password_confirmation" required>
                                <label for="password-confirm">Confirm Password</label>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block red white-text">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="s12">
                            <button type="submit" class="btn btn-primary">
                                Reset Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
