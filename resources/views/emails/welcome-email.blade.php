@component('mail::message')
# Welcome to igCoon

This is a simple ig clone app still on developement, check it out.

@component('mail::button', ['url' => '/'])
Visit Home
@endcomponent

All The Best,<br>
{{ config('app.name') }}
@endcomponent
