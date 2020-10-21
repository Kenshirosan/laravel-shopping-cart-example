<div class="informations">
    <div class="card">
        <div class="row">
            <div class="card-content">
                <h4 class="card-title blue-text center">Your informations</h4>
                <small>
                    <strong>Your credit card number is not stored anywhere</strong> and never touches our server.
                    Our <a href="https://stripe.com/us" class="green-text">
                            <strong class="security-infos">Secure Payment </strong></a> Provider is
                        <a href="https://www.pcisecuritystandards.org/" class="text-success">
                            <strong class="security-infos">PCI compliant</strong>
                        </a> and takes it from here.
                </small>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="row">
            <div class="card-content">
                <div class="col s12">
                    <span class="card-title">
                        <h4 class="center blue-text">Shipping Address and Order Type</h4>
                    </span>
                </div>
                <div class="container">
                    <label>
                        <input type="radio" name="order_type" value="Delivery" checked />
                        <span class="red-text">Delivery</span>
                    </label>
                    <label>
                        <input type="radio" name="order_type" value="Pick-up" />
                        <span class="red-text">Pick-up</span>
                    </label>
                    <div class="input-field col-s12 pickup-time{{ $errors->has('pickup_time') ? ' has-error' : '' }}">
                        <input
                            type="time"
                            id="time"
                            class="black-text"
                            min="11:00"
                            max="21:59"
                            value="{{ Carbon\Carbon::now()->addMinutes(30)->format('H:i') }}"
                            required
                            name="pickup_time"
                        />
                        <span class="validity prefix"></span>
                        <label for="time" class="orange-text"
                            >Pick-up hour (11am to 10pm, 24hr format), minimum 30 minutes
                            from now
                        </label>
                    </div>
                    <cart-addresses :user="{{ Auth::user() }}" :addresses="{{ Auth::user()->addresses }}"></cart-addresses>
                </div>
            </div>
        </div>
    </div>
</div>
@section('pickup-script')
@include('javascript.time')
@endsection
