@extends('adminlte::page')

@section('title')
    Message {{$message->id}}
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
                    <div class="info-box-content">
                        <a href="mailto:{{ $message->email }}">
                            <span class="info-box-text"><strong>Click to answer to: {{ $message->email}}</strong></span>
                        </a>
                    </div>
                    <div class="info-box-content">
                            <p><span class="info-box-text">{{ $message->name}}</span></p>
                            <p><span class="info-box-text">{{ $message->phone}}</span></p>
                            <p><span class="info-box-number">{{ $message->message }}</span></p>
                            <p><span class="info-box-text">Message received on: {{ $message->created_at->toDateString() }}</span></p>
                    </div>
                    <div class="info-box-content">
                        <form method="POST" action="/delete/{{ $message->id }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection