@extends('adminlte::page')

@section('title')
    Your employees
@endsection

@section('content')
    <section class="content">
        <div class="row">
            @if($employees->isEmpty())
                <h2 class="text-info text-center">No employees yet</h2>
            @else
                @foreach($employees as $employee)
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="fa fa-user-o"></i></span>
                            <div class="info-box-content">
                                <a href="/employee/{{ $employee->id }}">
                                    <span class="info-box-number">{{ $employee->id }}</span>
                                    <span class="info-box-text">{{ $employee->email}}</span>
                                    <span class="info-box-text">{{ $employee->name}}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>
@endsection