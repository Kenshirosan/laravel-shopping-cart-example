@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-content">
                <div class="card-title">Reset Password</div>
                @if (session('status'))
                    <div class="alert green">
                        {{ session('status') }}
                    </div>
                @endif

                <form role="form" method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}
                    <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">email</i>
                            <input id="email" type="email" class="black-text" name="email" value="{{ old('email') }}" required>
                            <label for="email">E-Mail Address</label>

                            @if ($errors->has('email'))
                                <span class="help-block red">
                                    <strong class="black-text">{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="s12">
                        <button type="submit" class="btn">
                            Send Password Reset Link
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
