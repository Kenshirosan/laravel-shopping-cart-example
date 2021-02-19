@extends('adminlte::page')

@section('title')
    Update {{ $product->name }}
@endsection

@section('content')
    <h3 class="text-center text-info product-layout-img">Update {{ $product->name }}</h3>
    @if($product->isEightySix())
        <div class="alert alert-danger">
            <h3 class="text-center product-layout-img"><i class="fa fa-info-circle"></i> {{ $product->name }} is 86</h3>
        </div>
    @endif
    <form class="form-horizontal" method="POST" action="/update/{{ $product->slug }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    {{--  NAME OF MEAL --}}
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Name of Meal</label>
        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{ $product->name }}" autofocus required>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    {{-- holiday_special --}}
    <div class="form-group{{ $errors->has('holiday_special') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Holiday Special ?</label>
        <div class="col-md-6">
            <input type="radio" name="holiday_special" value="0" checked> No<br>
            <input type="radio" name="holiday_special" value="1"> Yes<br>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('subcategory') ? ' has-error' : '' }}">
        <label for="subcategory" class="col-md-4 control-label">Subcategory ?</label>
        <div class="col-md-6">
            <input type="radio" name="subcategory" value=""> No<br>
            @foreach($subcategories as $subcategory)
                @if($product->type === $subcategory)
                    <input checked type="radio" name="subcategory" value="{{ $product->type }}"> {{ $product->type }}<br>
                @else
                    <input type="radio" name="subcategory" value="{{ $subcategory }}"> {{ $subcategory }}<br>
                @endif
            @endforeach
            @if ($errors->has('subcategory'))
                <span class="help-block">
                    <strong>{{ $errors->first('subcategory') }}</strong>
                </span>
            @endif
        </div>
    </div>



    @if( !$product->groups )
    <div class="form-group{{ $errors->has('option_group_id') ? ' has-error' : '' }}">
        <label for="option" class="col-md-4 control-label">Option 1</label>
        <div class="col-md-6">
            <select id="option_group_id" class="form-control" name="option_group_id[]">
                <option value="">Choose option group</option>
                @foreach($optionGroups as $optionGroup)
                    <option value="{{ $optionGroup->id }}">{{ $optionGroup->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @endif

    {{-- DB row option_group_id --}}
    @if( $product->groups )
    <div class="form-group{{ $errors->has('option_group_id') ? ' has-error' : '' }}">
        <label for="option" class="col-md-4 control-label">Option 1</label>
        <div class="col-md-6">
            <select multiple id="option_group_id" class="form-control" name="option_group_id[]">
                @if($product->groups)
                    @foreach($product->groups as $group)
                        <option value="{{ $group->id }}" selected>{{ $group->name }}</option>
                    @endforeach
                @endif
                <option value="" class="text-danger">No option, Select all options you need</option>>
                @foreach($optionGroups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @endif

    {{--  CATEGORY --}}
    <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
        <label for="category_id" class="col-md-4 control-label">Category</label>
        <div class="col-md-6">
            <select id="category_id" class="form-control" name="category_id" value="{{ old('category_id') }}" autofocus required>
                <option value="{{ $product->category->id }}">{{ $product->category->name }}</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            @if ($errors->has('category_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('category_id') }}</strong>
                </span>
            @endif
            </select>
        </div>
    </div>

    {{--  SLUG --}}
    <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
        <label for="slug" class="col-md-4 control-label">Slug (ex: name-of-meal)</label>

        <div class="col-md-6">
            <input id="slug" type="text" class="form-control" name="slug" value="{{ $product->slug }}" required>

            @if ($errors->has('slug'))
                <span class="help-block">
                    <strong>{{ $errors->first('slug') }}</strong>
                </span>
            @endif
        </div>
    </div>

    {{--  DESCRIPTION --}}
    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        <label for="description" class="col-md-4 control-label">Description</label>

        <div class="col-md-6">
            <input id="description" type="text" class="form-control" name="description" value="{{ $product->description }}" required>

            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
    </div>

    {{--  PRICE --}}
    <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
        <label for="price" class="col-md-4 control-label">Price</label>

        <div class="col-md-6">
            <input id="price" type="number" step="any" class="form-control" name="price" value="{{ $product->price }}" required>

            @if ($errors->has('price'))
                <span class="help-block">
                    <strong>{{ $errors->first('price') }}</strong>
                </span>
            @endif
        </div>
    </div>

    {{--  IMAGE --}}
    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
        <label for="image" class="col-md-4 control-label">Image</label>

        <div class="col-md-6">
            <input id="image"
                    type="file"
                    accept="image/png, image/jpg"
                    class="form-control"
                    name="image">
            @if ($errors->has('image'))
                <span class="help-block">
                    <strong>{{ $errors->first('image') }}</strong>
                </span>
            @endif
            <div class="col-md-6">
                <p class="text-info">Current Main Image</p>
                <img src="{{ asset('img/' . $product->image) }}"
                    class="img-responsive"
                    alt="Picture of {{ $product->name }}">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="submit" class="col-md-4 control-label"></label>
        <div class="col-md-6">
            <input type=submit class="btn btn-info form-control" value="Update Product">
        </div>
    </div>
</form>

<div class="mb-100"></div>

<form action="{{ $action }}" method="POST" class="form-horizontal">
    {{ csrf_field() }}
    @if($method == 'DELETE')
        {{ method_field('DELETE') }}
    @endif
    <div class="form-group{{ $errors->has('eighty_six') ? ' has-error' : '' }}">
        <label for="eighty_six" class="col-md-4 control-label"><strong class="text-danger">86 Product ?</strong></label>
        <div class="col-md-6">
            <input type="radio" name="eighty_six" value="0" {{ $product->isEightySix() ? 'checked' : '' }}> No<br>
            <input type="radio" name="eighty_six" value="1" {{ $product->isEightySix() ? '' : 'checked' }}> Yes<br>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('eighty_six') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label for="submit" class="col-md-4 control-label"></label>
        <div class="col-md-6">
            <input type=submit class="btn {{ $product->isEightySix() ? 'btn-primary' : 'btn-danger' }} form-control"
                   value="{{ $product->isEightySix() ? 'Click to add Product' : '86 product' }}">
        </div>
    </div>
</form>
@endsection
