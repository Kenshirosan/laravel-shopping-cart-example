@extends('adminlte::page')

@section('title')
    add an option
@endsection

@section('content')
    <add-option-group action="{{ $action }}"></add-option-group>
@endsection