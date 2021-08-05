@component('mail::message')
# Introduction

Hi, {{ $data['name'] }} Thank you for Form Submit.

@component('mail::table')
| Your Submited | Form          |
| ------------- |:-------------:|
@foreach (json_decode($data,true) as $key=>$value )
| __{{str_replace("_"," ",ucfirst($key))}} :__          | {{$value}}   |
@endforeach
@endcomponent



@component('mail::button', ['url' => env('APP_URL')])
Visit Our Website
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent


