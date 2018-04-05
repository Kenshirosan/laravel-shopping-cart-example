<form class="form-horizontal" method="POST" action="/insertproduct" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{--  NAME OF MEAL --}}
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Name of Meal</label>
        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus required>
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

    {{-- DB row option_group_id --}}
    <div class="form-group{{ $errors->has('option_group_id') ? ' has-error' : '' }}">
        <label for="option" class="col-md-4 control-label">Options 1</label>
        <div class="col-md-6">
            <select id="option_group_id" class="form-control" name="option_group_id">
                <option value="3">Please pick one</option>
                @foreach($optionGroups as $optionGroup)
                    <option value="{{ $optionGroup->id }}">{{ $optionGroup->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- DB row second_option_group_id --}}
    <div class="form-group{{ $errors->has('option_group_id') ? ' has-error' : '' }}">
        <label for="option" class="col-md-4 control-label">Options 2</label>
        <div class="col-md-6">
            <select id="second_option_group_id" class="form-control" name="second_option_group_id">
                <option value="3">Please pick one</option>
                @foreach($secondOptionGroups as $secondOptionGroup)
                    <option value="{{ $secondOptionGroup->id }}">{{ $secondOptionGroup->name }}</option>
                @endforeach
            </select>
        </div>
    </div>


    {{--  CATEGORY --}}
    <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
        <label for="category_id" class="col-md-4 control-label">Category</label>
        <div class="col-md-6">
            <select id="category_id" class="form-control" name="category_id" value="{{ old('category_id') }}" autofocus required>
                <option value="8">Please pick one</option>
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
            <input id="slug" type="text" class="form-control" name="slug" value="{{ old('slug') }}" required>

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
            <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required>

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
            <input id="price" type="number" step="any" class="form-control" name="price" value="{{ old('price') }}" required>

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
            <input id="image" type="file" accept="image/png, image/jpg"  class="form-control" name="image" value="{{ old('image') }}" required>
            @if ($errors->has('image'))
                <span class="help-block">
                    <strong>{{ $errors->first('image') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label for="submit" class="col-md-4 control-label"></label>
        <div class="col-md-6">
            <input type=submit class="btn btn-info form-control" value='Add Product' class="btn btn-primary">
        </div>
    </div>
</form>