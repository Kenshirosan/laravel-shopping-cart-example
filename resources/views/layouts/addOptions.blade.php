@extends('adminlte::page')

@section('title')
    add an option
@endsection

@section('content')
    @include('messages.messages')
    <h1>Hello, {{ Auth::user()->name }}</h1>
    <form class="form-horizontal" method="POST" action="/add-options" enctype="multipart/form-data">
        @include('includes.error')
        {{ csrf_field() }}


        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Option Name</label>
            <div class="col-md-6">
                <input id="name" placeholder="ex: Long sleeve, Short sleeve..." type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus required>
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
         {{-- DB row option_group_id --}}
        <div class="form-group{{ $errors->has('option_group_id') ? ' has-error' : '' }}">
            <label for="option" class="col-md-4 control-label">Option Group</label>
            <div class="col-md-6">
                <select id="option_group_id" class="form-control" name="option_group_id">
                    @foreach($optionGroups as $optionGroup)
                        <option value="{{ $optionGroup->id }}">{{ $optionGroup->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="name" class="col-md-4 control-label"></label>
            <div class="col-md-6">
                <input type=submit value='Submit' class="btn btn-primary">
            </div>
        </div>
    </form>
@endsection