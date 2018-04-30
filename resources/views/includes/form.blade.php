<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">
    <div class="informations">
    <div class="panel panel-info">
        <div class="panel-heading">
            <p>Your informations</p>
            <small>
                <p><strong>Your credit card number is not stored anywhere</strong> and never touches our server.</p>
                <p>Our <a href="https://stripe.com/us" class="text-success">
                    <strong class="security-infos">Secure Payment </strong></a> Provider is
                    <a href="https://www.pcisecuritystandards.org/" class="text-success">
                        <strong class="security-infos">PCI compliant</strong>
                    </a> and takes it from here.
                </p>
            </small>
        </div>
        <div class="panel-body">
             <div class="row">
                {{-- <label class="radio-inline">
                    <toggle v-model="checked" class="ml-30"></toggle>
                </label> --}}
            <div class="container">
                <label class="radio-inline">
                    <input type="radio" name="order_type" value="Delivery" checked>Delivery
                </label>
                <label class="radio-inline">
                    <input type="radio" name="order_type" value="Pick-up">Pick-up
                </label>
            </div>
            </div>
            <div class="col-md-12">
                <div class="pickup-time form-group{{ $errors->has('pickup_time') ? ' has-error' : '' }}">
                    <label for="pickup-time">Pick-up hour (11am to 10pm, 24hr format)</label>
                    <input type="time"
                            class="form-control"
                            min="12:00"
                            max="21:59"
                            value="17:00"
                            required
                            name="pickup_time">
                    <span class="validity"></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <h4>Shipping Address</h4>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-xs-12">
                    <strong>First Name:</strong>
                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" />
                </div>
                <div class="span1"></div>
                <div class="col-md-6 col-xs-12">
                    <strong>Last Name:</strong>
                    <input type="text" name="last_name" class="form-control" value="{{ Auth::user()->last_name }}" />
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                <p>
                    <strong>Address: </strong>
                    <span class="text-info text-center">You may modify the address field if you wish to be delivered somewhere else. However, the address must be located within one of the zipcodes listed below.
                    </span>
                </p>
                    <input type="text" name="address" class="form-control" value=" {{ Auth::user()->address }} " />
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12"><strong>Address 2:</strong></div>
                <div class="col-md-12">
                    <input type="text" name="address2" class="form-control" value="{{  Auth::user()->address2 }}" />
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12"><strong>Zipcode:</strong></div>
                <div class="col-md-12">
                    <select id="zipcode" name="zipcode" class="form-control" value="{{ Auth::user()->zipcode }}">
                        <option value="{{ Auth::user()->zipcode }}">{{ Auth::user()->zipcode }}</option>
                        <option value="10001">10001</option>
                        <option value="10002">10002</option>
                        <option value="10003">10003</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12"><strong>Phone Number:</strong></div>
                <div class="col-md-12">
                    <input type="tel" readonly name="phone_number" class="form-control" value="{{ Auth::user()->phone_number }}" />
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12"><strong>Email Address:</strong></div>
                <div class="col-md-12">
                    <input type="email" readonly name="email" class="form-control" value="{{ Auth::user()->email }}" />
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12"><strong>Additional Comments:</strong></div>
                <div class="col-md-12">
                    <textarea maxlength="500" name="comments" class="form-control" placeholder="Anything we need ton know? Allergies? A name on the order ? 500 characters max"></textarea>
                </div>
            </div>
        <input type="hidden" name="code" value="{{ $code }}">
        <input type="hidden" name="total" value="{{ $total }}">
            <!--SHIPPING METHOD END-->
    </div>
    </div>
</div>

@section('pickup-script')
    @include('javascript.time')
@endsection