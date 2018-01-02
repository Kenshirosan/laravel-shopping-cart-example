<form class="form-horizontal" method="POST" action="/edit-profile/{{$user->id}}">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    <div class="form-group">
        <div class="col-md-12">
            <h4>All fields are mandatory</h4>
        </div>
    </div>

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <div class="col-md-12">
            <strong>First Name:</strong>
            <input type="text" name="name" readonly class="form-control" value="{{ $user->name }}" placeholder="First Name" required/>
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
            <input type="text" name="last_name" readonly class="form-control" value="{{ $user->last_name }}" placeholder="Last Name" required/>
        </div>
        @if ($errors->has('last_name'))
            <span class="help-block">
                <strong>{{ $errors->first('last_name') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
        <div class="col-md-12"><strong>Address:</strong></div>
        <div class="col-md-12">
            <input type="text" name="address" class="form-control" value="{{ $user->address }}" placeholder="Address" required/>
        </div>
        @if ($errors->has('address'))
            <span class="help-block">
                <strong>{{ $errors->first('address') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
        <div class="col-md-12"><strong>Address 2:</strong></div>
        <div class="col-md-12">
            <input type="text" name="address2" class="form-control" value="{{ $user->address2 }}" placeholder="Address 2" required/>
        </div>
        @if ($errors->has('address2'))
            <span class="help-block">
                <strong>{{ $errors->first('address2') }}</strong>
            </span>
        @endif
    </div>


    <div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
        <div class="col-md-12"><strong>Zipcode:</strong></div>
        <div class="col-md-12">
            <select id="zipcode" name="zipcode" class="form-control" placeholder="Zipcode">
                <option default value="{{ $user->zipcode }}">{{ $user->zipcode }}</option>
                <option value="10001">10001</option>
                <option value="10002">10002</option>
                <option value="10003">10003</option>

            </select>
        </div>
    </div>

    <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
        <div class="col-md-12"><strong>Phone Number:</strong></div>
        <div class="col-md-12">
            <input type="text" name="phone_number" class="form-control" value="{{ preg_replace('/[() -]/', '', $user->phone_number) }}" placeholder="Phone Number" required/>
        <small class="text-info">
            {{$user->phone_number}}
        </small>
        </div>
        @if ($errors->has('phone_number'))
            <span class="help-block">
                <strong>{{ $errors->first('phone_number') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <div class="col-md-12"><strong>Email Address:</strong></div>
        <div class="col-md-12">
            <input id="email" type="email" name="email" class="form-control" value="{{ $user->email }}" placeholder="Your Email" required/>
            <small class="text-info">
                Please note you'll need to verify your email address again should you choose to update it
            </small>
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
            <input type="password" name="password" class="form-control" value="{{ old('password')}}" placeholder="Your Password" required/>
        </div>
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
            <input type="submit" value ="Update your credentials" class="btn btn-primary">
            <p>To change your password, logout, go to the login page and click forgot password</p>
        </div>
    </div>
</form>