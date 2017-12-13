@extends('adminlte::page')

@section('title')
    Add Holiday's title
@endsection

    @section('content')
        <form class="form-horizontal" method="POST" action="/add-holiday-title">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('holiday_page_title') ? ' has-error' : '' }}">
                <label for="holiday_page_title" class="col-md-4 control-label">Enter a title</label>
                <div class="col-md-6">
                    <input id="holiday_page_title" type="text" class="form-control" name="holiday_page_title" value="{{ old('holiday_page_title') }}" autofocus required>
                    @if ($errors->has('holiday_page_title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('holiday_page_title') }}</strong>
                        </span>
                    @endif
                    <br>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type=submit value='Submit' class="btn btn-info">
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <hr>
        <div class="container">
        @if(! $titles->isEmpty())
                <div class="col-md-6">
                    @foreach($titles as $title)
                        {{ $title->holiday_page_title }}
                        <form action="/holiday/{{ $title->id }}/delete" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endforeach
                </div>
            @else
                <div class="col-md-6">
                    <h3 class="text-info">No Holiday page</h3>
                    <p class="text-primary">Please check you deleted your <strong><a class="text-danger" href="/holidays-special">specials</a></strong></p>
                </div>
            @endif
        </div>
@endsection
</script>