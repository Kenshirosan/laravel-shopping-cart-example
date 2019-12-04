<div class="informations">
    <div class="card">
        <div class="row">
            <span class="card-title">
                <h5 class="blue-text center">Your informations</h5>
            </span>
            <div class="card-content">
                <small>
                    <p><strong>Your credit card number is not stored anywhere</strong> and never touches our server.</p>
                    <p>Our <a href="https://stripe.com/us" class="green-text">
                            <strong class="security-infos">Secure Payment </strong></a> Provider is
                        <a href="https://www.pcisecuritystandards.org/" class="text-success">
                            <strong class="security-infos">PCI compliant</strong>
                        </a> and takes it from here.
                    </p>
                </small>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="row">
            <div class="card-content">
                {{-- <label class="radio-inline">
                        <toggle v-model="checked" class="ml-30"></toggle>
                    </label> --}}
                <div class="col s12">
                    <span class="card-title">
                        <h4 class="center blue-text">Shipping Address and Order Type</h4>
                    </span>
                </div>
                <div class="container">
                    <label>
                        <input type="radio" name="order_type" value="Delivery" checked>
                        <span class="red-text">Delivery</span>
                    </label>
                    <label>
                        <input type="radio" name="order_type" value="Pick-up">
                        <span class="red-text">Pick-up</span>
                    </label>
                </div>
                <div class="input-field col-s12 pickup-time{{ $errors->has('pickup_time') ? ' has-error' : '' }}">
                    <input type="time" id="time" class="black-text" min="11:00" max="21:59" value="{{ Carbon\Carbon::now()->addMinutes(30)->format('H:i') }}" required name="pickup_time">
                    <span class="validity prefix"></span>
                    <label for="time" class="orange-text">Pick-up hour (11am to 10pm, 24hr format), minimum 30 minutes from now</label>
                </div>

                <div class="input-field col s6 ">
                    <i class="material-icons prefix">account_circle</i>
                    <input class="black-text" type="text" id="name" name="name" class="form-control" value="{{ Auth::user()->name }}" />
                    <label for="name">Your Name</label>
                </div>

                <div class="input-field col s6">
                    <i class="material-icons prefix">account_circle</i>
                    <input class="black-text" type="text" id="first_name" name="last_name" class="form-control" value="{{ Auth::user()->last_name }}" />
                    <label for="last_name">First Name</label>
                </div>

                <small class="green-text">
                    You may modify the address field if you wish to be delivered somewhere else. However, the address must be located within one of the zipcodes listed below.
                </small>
                <div class="input-field col s12">
                    <i class="material-icons prefix">my_location</i>
                    <input class="black-text" type="text" id="address" name="address" class="form-control" value=" {{ Auth::user()->address }} " />
                    <label for="address">Address</label>
                </div>

                <div class="input-field col s12">
                    <i class="material-icons prefix">my_location</i>
                    <input class="black-text" type="text" id="address2" name="address2" class="form-control" value="{{  Auth::user()->address2 }}" />
                    <label for="address2">Address 2</label>
                </div>

                <div class="input-field col s12">
                    <i class="material-icons prefix">my_location</i>
                    <select id="zipcode" name="zipcode">
                        <option value="{{ Auth::user()->zipcode }}">{{ Auth::user()->zipcode }}</option>
                        <option value="10001">10001</option>
                        <option value="10002">10002</option>
                        <option value="10003">10003</option>
                    </select>
                    <label for="zipcode">Zipcode</label>
                </div>

                <div class="input-field col s12">
                    <i class="material-icons prefix">phone</i>
                    <input class="black-text" id="tel" type="tel" readonly name="phone_number" value="{{ Auth::user()->phone_number }}" />
                    <label for="Phone">Phone</label>
                </div>

                <div class="input-field col s12">
                    <i class="material-icons prefix">email</i>
                    <input type="email" class="black-text" readonly name="email" value="{{ Auth::user()->email }}" />
                    <label for="email">Email</label>
                </div>

                <div class="input-field col s12">
                    <i class="material-icons prefix">message</i>
                    <textarea maxlength="500" id="comments" name="comments" class="black-text materialize-textarea" placeholder="Anything we need ton know? Allergies? A name on the order ? 500 characters max"></textarea>
                    <label for="comments">Comments</label>
                </div>
                <input type="hidden" name="code" value="{{ $code }}">
                <input type="hidden" name="total" value="{{ $total }}">
            </div>
        </div>
    </div>
</div>
@section('pickup-script')
@include('javascript.time')
@endsection