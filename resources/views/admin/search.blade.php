@extends('adminlte::page')

@section('title')
    Search
@endsection

@section('content')
<div class="row">
    <div class="container">
        <div class="search">
            <h1 class="text-center text-primary">Search an Order</h1>
            <p>&nbsp;</p>
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="input-group">
                        <span class="input-group-addon" style="color: white; background-color: rgb(124,77,255);">Search</span>
                        <input type="text" autofocus autocomplete="off" id="search" class="form-control input-lg" placeholder="Search an order by number or name">
                    </div>
                </div>
            </div>
        </div>
        <!-- search box container ends  -->
        <div id="txtHint" class="title-color" style="padding-top:50px; text-align:center;" ><em>Results :</em></div>
    </div>
</div>
@endsection

@section('search-script')
    @include('javascript.research')
@endsection