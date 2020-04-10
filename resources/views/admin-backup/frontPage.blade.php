@extends('adminlte::page')

@section('title')
    Add or change title, subtitle, image.
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="/front-page-title" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Add or change title, subtitle and image to the front page
                        </div>
                        <div class="panel-body">

                            <div class="form-group">
                                <div class="col-md-12">
                                    <h4>All fields are mandatory</h4>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <strong>Title:</strong>
                                    <input type="text" name="title" class="form-control"
                                        value="{{ $frontPageInfos ? $frontPageInfos->title : '' }}"
                                        placeholder="{{ $frontPageInfos ? $frontPageInfos->title  : 'Enter a title'}}"
                                        required/>
                                </div>
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('subtitle') ? ' has-error' : '' }}">
                                <div class="span1"></div>
                                <div class="col-md-12">
                                    <strong>Subtitle</strong>
                                    <input type="text" name="subtitle" class="form-control"
                                        value="{{ $frontPageInfos ? $frontPageInfos->subtitle : '' }}"
                                        placeholder="{{ $frontPageInfos ? $frontPageInfos->subtitle : 'Enter a subtitle'}}"
                                        required/>
                                </div>
                                @if ($errors->has('subtitle'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subtitle') }}</strong>
                                    </span>
                                @endif
                            </div>


                           {{--  IMAGE --}}
                             <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                <label for="image" class="col-md-4 control-label">Image</label>
                                <div class="col-md-6">
                                    <input id="image" type="file" accept="image/png, image/jpg"  class="form-control"
                                        name="image"
                                        required>
                                    @if ($errors->has('image'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('color') ? ' has-error' : '' }}">
                                <label for="color" class="col-md-4 control-label">Text Color</label>
                                <div class="col-md-6">
                                    <input id="color" type="color" class="form-control" name="color"
                                        value="{{ $frontPageInfos ?  $frontPageInfos->color : '' }}"
                                        placeholder="{{ $frontPageInfos ?  $frontPageInfos->color : 'Pick a color'}}"
                                        required>
                                    @if ($errors->has('color'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('color') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('background_color') ? ' has-error' : '' }}">
                                <label for="background_color" class="col-md-4 control-label">Background Color</label>
                                <div class="col-md-6">
                                    <input id="background_color" type="color" class="form-control"
                                        name="background_color"
                                        value="{{ $frontPageInfos ? $frontPageInfos->background_color : ''}}"
                                        placeholder="{{ $frontPageInfos ?  $frontPageInfos->background_color : 'Pick a color' }}"
                                        required>
                                    @if ($errors->has('background_color'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('background_color') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('well_color') ? ' has-error' : '' }}">
                                <label for="well_color" class="col-md-4 control-label">Categories Background Color</label>
                                <div class="col-md-6">
                                    <input id="well_color" type="color" class="form-control" name="well_color"
                                        value="{{ $frontPageInfos ?  $frontPageInfos->well_color : ''}}"
                                        placeholder="{{ $frontPageInfos ?  $frontPageInfos->well_color : 'Pick a color' }}"
                                        required>
                                    @if ($errors->has('well_color'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('well_color') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('categories_title_color') ? ' has-error' : '' }}">
                                <label for="categories_title_color"
                                        class="col-md-4 control-label">Categories Title Color</label>
                                <div class="col-md-6">
                                    <input id="categories_title_color" type="color" class="form-control"
                                        name="categories_title_color"
                                        value="{{ $frontPageInfos ? $frontPageInfos->categories_title_color : ''}}"
                                        placeholder="{{ $frontPageInfos ? $frontPageInfos->categories_title_color : 'Pick a color'}}"
                                        required>
                                    @if ($errors->has('categories_title_color'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('categories_title_color') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="submit" value ="Submit" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row text-center">
            @if($frontPageInfos)
                <p>Current title: <span class="text-info">{{ $frontPageInfos['title'] }}</span></p>
                <p>Current subtitle: <span class="text-info">{{ $frontPageInfos['subtitle'] }}</span></p>
                <p><span style="color:{{ $frontPageInfos->color  }}">Current color</span></p>
                <p><span style="color:{{ $frontPageInfos->background_color  }}">Current Page Background Color</span></p>
                <p><span style="color:{{ $frontPageInfos->well_color  }}">Current Categories Background Color</span></p>
                <p><span style="color:{{ $frontPageInfos->categories_title_color  }}">Current Categories Title Color</span></p>
                <p>Current image:
                    <img src="{{ $frontPageInfos['image'] }}" alt="Site Main Image" class="img-responsive">
                </p>
            @endif
        </div>
    </div>
@endsection