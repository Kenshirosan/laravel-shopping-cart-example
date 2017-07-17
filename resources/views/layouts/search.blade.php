@extends('layouts.master')

@section('title')
    Search
@endsection

@section('content')
    <a href="/panel" class="btn btn-primary text-center">Back</a>
    <div class="search">
            <h3 class="text-center title-color"></h3>
            <p>&nbsp;</p>
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="input-group">
                        <span class="input-group-addon" style="color: white; background-color: rgb(124,77,255);">Rechercher</span>
                        <input type="text" autofocus autocomplete="off" id="search" class="form-control input-lg" placeholder="Search an order by its number">
                    </div>
                </div>
            </div>
        </div>
        <!-- search box container ends  -->
        <div id="txtHint" class="title-color" style="padding-top:50px; text-align:center;" ><b>Résultats :</b></div>
@endsection

@section('search-ajax')
    <script>
    $(document).ready(function(){
        $("#search").keyup(function(){
            var str=  $("#search").val();
            if(str == "") {
                $( "#txtHint" ).html("<b>Results ..</b>");
            }else {
                $.get( "{{ url('/livesearch?id=') }}"+str, function( data ) {
                    $( "#txtHint" ).html( data );
                });
            }
        });
    });
    </script>
@endsection
