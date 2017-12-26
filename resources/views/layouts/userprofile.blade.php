@extends('adminlte::page')

@section('title')
    Edit Your profile
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
                            <p>{{ preg_replace('/[]["]/ ', ' ', $order->items) }}</p>
                            <order-progress status="{{ $order->status->name}}" initial=" {{ $order->status->percent }}" order_id="{{ $order->id }}"></order-progress>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        @include('includes.profileForm')
                        @if(! auth()->user()->isAdmin())
                            <a class="btn btn-danger pull-right" href="/erase/{{ $user->id }}">
                                Delete your account
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
