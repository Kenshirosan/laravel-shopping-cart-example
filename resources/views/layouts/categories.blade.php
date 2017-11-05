@extends('adminlte::page')

@section('title')
    Add a category
@endsection

@section('content')
    @include('messages.messages')
<h1 class="text-center text-info">Create a Category</h1>
<hr>
    <form action="/add-category" class="form-horizontal" method="POST">
        {{ csrf_field() }}

        {{-- COUPONS name --}}
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Category name</label>
            <div class="col-md-6">
                <input id="name" type="text" min="0" step="5" class="form-control" placeholder="category name" name="name" value="{{ old('name') }}" autofocus required>
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
        <label for="submit" class="col-md-4 control-label"></label>
            <div class="col-md-6">
                <input type=submit value='Submit' class="btn btn-primary">
            </div>
        </div>
    </form>

<div class="container">
    @if(!$categories->isEmpty())
        <h1>Categories Available :</h1>
        @foreach($categories as $category)
            <p class="col-md-4">{{ $category->name }} : <span class="text-info">{{ $category->name }}</span></p>
        @endforeach
    @else
        <h1>No Categories created</h1>
    @endif
</div>
@endsection