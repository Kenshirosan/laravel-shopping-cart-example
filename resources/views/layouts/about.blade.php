@extends('layouts.master')

@section('title')
    About Our Place
@endsection

@section('content')
    <h1 class="text-warning text-center">About our restaurant</h1>
    <div class="about-picture" style="text-align: center; margin: 0 auto">
        <img src="/images/delivery.gif" alt="Anta" class="img-responsive" style="max-width:50%;">
    </div>
        <div class="about"></div>
@endsection

@section('about-script')
    <script>
        const div = document.querySelector('.about');
        axios.get('/about')
            .then(res => div.innerHTML = res.data.about || '');
    </script>
@endsection