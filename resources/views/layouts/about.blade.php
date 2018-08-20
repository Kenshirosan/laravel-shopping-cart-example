@extends('layouts.master')

@section('title')
    About Our Place
@endsection

@section('content')
<div class="container">
    <h1 class="orange-text center">About our restaurant</h1>
    <div class="about-picture center">
        <img src="/images/delivery.gif" alt="Delivery Illustration" class="responsive-img">
    </div>
    <div class="about"></div>
</div>
<div class="spacer"></div>
@endsection

@section('about-script')
    <script>
        const div = document.querySelector('.about');
        axios.get('/about')
            .then(res => div.innerHTML = res.data.about || '{{ config('app.name') }}');
    </script>
@endsection