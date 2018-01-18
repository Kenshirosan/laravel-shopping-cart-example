@extends('adminlte::page')

@section('title')
    User {{$user->name}}
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-user-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ $user->email }}</span>
                        <span class="info-box-text">{{ $user->name }}</span>
                        <span class="info-box-text">{{ $user->phone_number }}</span>
                        <hr>
                        @if($user->isEmployee())
                            <form method="POST" action="/delete/{{ $user->id }}/user">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach( $user->orders as $order)
                <div class="col-md-4">
                    <ul class="list-group active">
                        <div class="list-group-item active">
                            <h4 class="list-group-item-heading">
                                <span class="info-box-text">{{ $order->id }}</span>
                            </h4>
                        </div>
                        <li class="list-group-item"><span class="info-box-text">{{ preg_replace('/[]:["]/ ', ' ', $order->items) }}</span></li>
                        <li class="list-group-item"><span class="info-box-text">{{ $order->price() }}</span></li>
                        {{-- <hr> --}}
                        <li class="list-group-item"><span class="info-box-text">{{ $order->created_at->diffForHumans() }}</span>
                            <small><strong>{{ $order->created_at->toFormattedDateString() }}</strong></small>
                        </li>
                    </ul>
                </div>
            @endforeach
        </div>
    </section>
@endsection