@component('mail::message')
# Password Reset Token

Please copy the below token to reset your password.

```{{$token}}```

Thanks,<br>
{{ config('app.name') }}
@endcomponent