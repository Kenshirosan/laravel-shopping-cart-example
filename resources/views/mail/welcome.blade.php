@component('mail::message')
# One Last Step

We just need you to confirm your email address to prove that you're a human.

@component('mail::button', ['url' => 'https://webcreation.rocks/register/confirm?token=' . $user->confirmation_token])
Confirm Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
