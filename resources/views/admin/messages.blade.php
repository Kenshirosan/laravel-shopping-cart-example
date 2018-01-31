@extends('adminlte::page')

@section('title')
    Messages
@endsection

@section('content')
    <section class="content">
        <div class="row">
            @if($messages->isEmpty())
                <h2 class="text-info text-center">No messages</h2>
            @else
            @foreach($messages as $message)
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
                            <div class="info-box-content">
                                <a href="/message/{{ $message->id }}">
                                    <span class="info-box-number">{{ $message->id }}</span>
                                    <span class="info-box-text">{{ $message->email}}</span>
                                    <span class="info-box-text">{{ $message->name}}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>
@endsection