@extends('adminlte::page')

@section('content')
@include('messages.messages')
<div class="text-center">
    <h1 class="text-info">Create unique coupons</h1>
    <p><small><em> These coupons are invalidated when customers use them</em></small></p>
</div>
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

    <br>

    <div class="text-center">
        <h1 class="text-info">Create coupons for everyone</h1>
        <p><small><em> These coupons needs to be invalidated manually</em></small></p>
    </div>
    <form action="/create-disposable-coupon" class="form-horizontal" method="POST">
        {{ csrf_field() }}
        {{-- COUPONS QUANTITY --}}
        <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
            <label for="quantity" class="col-md-4 control-label">How many coupons ?</label>
            <div class="col-md-6">
                <input id="quantity" type="number" min="0" step="1" class="form-control" placeholder="number of coupons to create" name="quantity" value="{{ old('quantity') }}" autofocus required>
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
                <input id="reward" type="number" min="0" step="1" class="form-control" placeholder="reward percentage" name="reward" value="{{ old('reward') }}" autofocus required>
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
    <br>
<div class="container">
    @if(!$coupons->isEmpty())
        <h1 class="text-success">Disposable Coupons :</h1>
        <div class="row">
            @foreach($coupons as $coupon)
                <p class="col-md-4">{{ $coupon->code }} : <span class="text-info">{{ $coupon->reward }}% </span></p>
            @endforeach
        </div>
    @if(!$couponsForAll->isEmpty())
        <h1 class="text-success">Coupons for Everyone :</h1>
        <div class="row">
            <p><small><em> These coupons needs to be invalidated manually</em></small></p>
            @foreach($couponsForAll as $coupon)
                <p class="col-md-4">{{ $coupon->code }} : <span class="text-info">{{ $coupon->reward }}% </span></p>
            @endforeach
            <form action="/coupons/{{ $coupon->id }}/delete" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    @endif
    @else
        <h1>No coupons created</h1>
    @endif
</div>
@endsection