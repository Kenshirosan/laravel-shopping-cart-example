@extends('adminlte::page')

@section('title')
    Your profile
@endsection

@section('content')
    @if( Auth::user()->id == $user->id)
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Order progress
                    </div>
                    <div class="panel-body">
                        @if($orders->isEmpty())
                            No order Today !
                        @else

                        @foreach($orders as $order)
                            <p class="text-info">Order number : <strong>{{ $order->id }}</strong></p>
                            <p class="text-info">Order received : <strong>{{ $order->created_at->toDateTimeString() }}</strong></p>
                            <p>{{ preg_replace('/[]{}:["]/ ', ' ', $order->items) }}</p>
                            <order-progress status="{{ $order->status->name}}" initial="{{ $order->status->percent }}" order_id="{{ $order->id }}"></order-progress>
                        @endforeach
                        @endif
                    </div>
                </div>

                <div class="panel panel-info">
                    <div class="panel-heading">Your informations</div>
                    <div class="panel-body">
                        @include('includes.profileForm')
                        @if(! auth()->user()->isEmployee())
                            <a class="btn btn-danger pull-right" href="/erase/{{ $user->id }}">
                                Delete your account
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <past-orders></past-orders>
            </div>
        </div>
    @endif
@endsection
