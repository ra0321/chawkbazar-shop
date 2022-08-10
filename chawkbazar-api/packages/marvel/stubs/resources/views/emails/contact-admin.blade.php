@component('mail::message')
# {{$details['subject']}}

Email: {{$details['email']}}

{{$details['description']}}

Thanks,<br>
{{ $details['name'] }}
@endcomponent