@extends('adminlte::page')

@section('title')
    Analytics
@endsection

@section('content')
    <div class="row">
        <h1 class="text-center text-info">Visitors per month</h1>
        <div class="col-md-12">
            <analytics
                :labels="{{ preg_replace("/(\d{4})/", "$1-", $dates->values()) }}"
                :sessions="{{ $sessions->values() }}"
                :pageviews="{{  $pageviews->values() }}"
                >
            </analytics>
        </div>
    </div>
@endsection