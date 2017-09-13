@extends('adminlte::page')

@section('title')
    Your best customers
@endsection

@section('content')

    <div class="container">

        <a href="/panel" class="btn btn-primary">back</a>
        <a href="/restaurantpanel" class="btn btn-primary">Add a product</a>
        <a href="/customer-orders" class="btn btn-primary">Today's order</a>

        <h1 class="text-center">
            You have <span class="text-info">{{ $users }}</span> registered customers.
        </h1>
    </div>
    <div class="well">
        <div class="row">
            @foreach($bestCustomers as $customers)
                <div class="col-xs-3">
                    <p class="text-muted">
                        {{ $customers->name }} {{ $customers->last_name }}  ordered $<strong class="text-success">{{ $customers->total / 100 }}</strong> worth in {{ $customers->year }}</p>
                    <p>
                        Email <a href="mailto:{{ $customers->email }}">{{ $customers->email }}</a>
                    </p>
                </div>
            @endforeach
        </div>
    </div>
    <div class="well well-lg">
        <div class="row">
            <div class="bootcards-list">
                <div class="panel panel-title">
                    @foreach($bestCustomers as $customers)
                    <div class="col-md-3">
                        <div class="list-group">
                          <a class="list-group-item" href="mailto:{{ $customers->email }}">
                            <h4 class="text-primary ">{{ $customers->name }} {{ $customers->last_name }}</h4>
                            <p class="list-group-item-text text-info">  ordered $<strong class="text-success">{{ $customers->total / 100 }}</strong> worth in {{ $customers->year }}</p>
                            <p>Click to email</p>
                          </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection