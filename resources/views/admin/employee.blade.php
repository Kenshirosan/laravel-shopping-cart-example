@extends('adminlte::page')

@section('title')
    Employee {{$employee->name}}
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-user-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ $employee->email}}</span>
                        <span class="info-box-text">{{ $employee->name}}</span>
                        <span class="info-box-text">{{ $employee->phone}}</span>
                        <form method="POST" action="/delete/{{ $employee->id }}/user">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection