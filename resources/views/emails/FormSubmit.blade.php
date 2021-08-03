@component('mail::message')
# Introduction

Hi, {{ $data->name }} Thank you for Form Submit.

@component('mail::table')
| Laravel       | Table         |
| ------------- |:-------------:|
| Name     | {{$data->name}}      |
| Email     | {{$data->email}} |
| Profile Name     | {{$data->profile_name}} |
| Profile Link     | {{$data->profile_link}} |
| Contact    | {{$data->contact}} |
| Location     | {{$data->location}} |
| Details     | {{$data->details}} |
@endcomponent

@component('mail::button', ['url' => env('APP_URL')])
Visit Our Website
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
