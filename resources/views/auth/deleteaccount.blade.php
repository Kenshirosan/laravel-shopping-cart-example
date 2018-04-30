@extends('adminlte::page')

@section('title')
    Delete your account
@endsection

@section('content')
        <h4 class="text-center text-danger">{{ $user->name }}, Are you sure you want to delete your account? this cannot be undone !</h4>
        <h5 class="text-center">All your data will be erased, except orders you made through our websites, due to legal concerns.</h5>

        <hr>

        <div class="row">
            <div class="col-md-6 text-center">
                <form class="horizontal" action="/erase/{{ $user->id }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button class="btn btn-danger list-group-item-danger">Yes, Delete my account</button>
                </form>
            </div>
            <div class="col-md-6 text-center">
                <a href="/user/{{ $user->name }}/profile" class="btn btn-primary list-group-item-primary">No, bring me back to safety</a>
            </div>
        </div>
@endsection
