@extends('adminlte::page')

@section('content')
@include('messages.messages')
<h1 class="text-center text-info">Create a coupon</h1>
<hr>
    <form action="/create-coupon" class="form-horizontal" method="POST">
        {{ csrf_field() }}
        {{-- COUPONS QUANTITY --}}
        <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
            <label for="quantity" class="col-md-4 control-label">How many coupons ?</label>
            <div class="col-md-6">
                <input id="quantity" type="number" min="0" step="5" class="form-control" placeholder="number of coupons to create" name="quantity" value="{{ old('quantity') }}" autofocus required>
                @if ($errors->has('quantity'))
                    <span class="help-block">
                        <strong>{{ $errors->first('quantity') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        {{-- COUPONS REWARD --}}
        <div class="form-group{{ $errors->has('reward') ? ' has-error' : '' }}">
            <label for="reward" class="col-md-4 control-label">Coupons percentage</label>
            <div class="col-md-6">
                <input id="reward" type="number" min="0" step="5" class="form-control" placeholder="reward percentage" name="reward" value="{{ old('reward') }}" autofocus required>
                @if ($errors->has('reward'))
                    <span class="help-block">
                        <strong>{{ $errors->first('reward') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
        <label for="submit" class="col-md-4 control-label"></label>
            <div class="col-md-6">
                <input type=submit value='Submit' class="btn btn-primary">
            </div>
        </div>
    </form>

<div class="container">
    @if(!$coupons->isEmpty())
        <h1>Valid Coupons :</h1>
        @foreach($coupons as $coupon)
            <p class="col-md-4">{{ $coupon->code }} : <span class="text-info">{{ $coupon->reward }}% </span></p>
        @endforeach
    @else
        <h1>No coupons created</h1>
    @endif
</div>
@endsection