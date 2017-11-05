@extends('adminlte::page')

@section('title')
    Edit css file
@endsection

@section('content')
@include('messages.messages')
    <form action="/edit-css" method="POST">
        {{ csrf_field() }}
        <textarea name="custom-css" placeholder="plain css here" id="" cols="100" rows="30">{!! file_get_contents($url) !!}</textarea>
        <input type="submit" class="btn btn-info" value="Save">
    </form>
@endsection