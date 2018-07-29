@extends('adminlte::page')

@section('title')
    add an option
@endsection

@section('content')
    <add-options action={{ $action }}></add-options>
@endsection