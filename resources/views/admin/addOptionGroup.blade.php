@extends('adminlte::page')

@section('title')
    Add an option
@endsection

@section('content')
    <add-option-group action="{{ $action }}" message="{{ $message }}"></add-option-group>
@endsection