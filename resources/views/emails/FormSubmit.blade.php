@component('mail::message')
# Introduction

Hi, {{ $data->name }} Thank you for Form Submit.
{{$data}}

@component('mail::table')
| Your Submited Form    |
| ------------- |:-------------:|
@php
    foreach($data as $key=>$value){
| echo $key;    | echo $value; |
    };
@endphp

@endcomponent

@component('mail::button', ['url' => env('APP_URL')])
Visit Our Website
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent


{{-- {{str_replace("_"," ",ucfirst($key))}} --}}
