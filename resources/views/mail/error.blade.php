@component('mail::message')

# Something Wrong Happened !



@foreach($errors as $error)
    {{ $error }}
@endforeach

{{ config('app.name') }}
@endcomponent