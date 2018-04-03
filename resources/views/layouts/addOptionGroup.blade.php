@extends('adminlte::page')

@section('title')
    add an option
@endsection

@section('content')

    <form class="form-horizontal" method="POST" action="{{ $method }}" enctype="multipart/form-data">
        @include('includes.error')
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Option Group Name</label>
            <div class="col-md-6">
                <input id="name" placeholder="Steak, Eggs,something that have many ways of serving.." type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus required>
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="name" class="col-md-4 control-label"></label>
            <div class="col-md-6">
                <input type=submit value='Submit' class="btn btn-primary">
            </div>
        </div>
    </form>

    <div class="container">
        <div class="col-md-6">
            <h2 class="text-info">Groups available :</h2>
            @foreach($optionGroups as $optionGroup)
                <p>{{ $optionGroup->name }}</p>
            @endforeach
        </div>
    </div>
@endsection