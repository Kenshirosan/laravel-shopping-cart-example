@extends('adminlte::page')

@section('title')
    Create a sale
@endsection

@section('content')
    <sales products="{{ $products }}"></sales>
@endsection