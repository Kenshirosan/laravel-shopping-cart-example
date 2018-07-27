@extends('adminlte::page')

@section('title')
    Add a Special's title
@endsection

@section('content')

<add-holiday-title></add-holiday-title>

{{-- <div class="row">
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
</div> --}}
@endsection