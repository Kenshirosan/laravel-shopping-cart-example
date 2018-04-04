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
                    <!--SHIPPING METHOD-->
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
                                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Title" required/>
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
                                    <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle') }}" placeholder="Subtitle" required/>
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
                                    <input id="image" type="file" accept="image/png, image/jpg"  class="form-control" name="image" value="{{ old('image') }}" required>
                                    @if ($errors->has('image'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('image') }}</strong>
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
        <div class="row">
            @if($frontPageInfos)
                <p>Current title: {{ $frontPageInfos['title'] }}</p>
                <p>Current subtitle:{{ $frontPageInfos['subtitle'] }}</p>
                <p>Current image:
                    <img src="{{ $frontPageInfos['image'] }}" alt="Site Main Image">
                </p>
            @endif
        </div>
    </div>
@endsection