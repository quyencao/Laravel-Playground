@component('mail::message')
# Welcome to my best website

Please activate your account by click the button below

@component('mail::button', ['url' =>   'http://localhost:8000/user/activation/' . $token])
Activation
@endcomponent

Thanks,<br>
{{ $user->name }}
@endcomponent
