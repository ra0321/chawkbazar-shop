{{--$order collection is available here--}}

@component('mail::message')
# New Order Received!

You have received a new order. Order tracking id {{$order->tracking_number}}

@component('mail::button', ['url' => $url ])
View Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent