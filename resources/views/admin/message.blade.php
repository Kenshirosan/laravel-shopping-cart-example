@extends('adminlte::page')

@section('title')
    Message {{$message->id}}
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
                    <div class="info-box-content">
                        <a href="mailto:{{ $message->email }}">
                            <span class="info-box-text">{{ $message->email}}</span>
                            <span class="info-box-text">{{ $message->name}}</span>
                            <span class="info-box-text">{{ $message->phone}}</span>
                            <span class="info-box-number">{{ $message->message }}</span>
                        </a>
                        <form method="POST" action="/delete/{{ $message->id }}">
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