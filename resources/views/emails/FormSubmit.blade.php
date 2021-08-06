@component('mail::message')
# You form has been submitted!

Hi, {{ $data['name'] }} Thank you for contacting us. We will get back to you soon.

@component('mail::table')
| Submited Form |               |
|:------------- |-------------:|
@foreach ($data as $key=>$value )
| __{{str_replace("_"," ",ucfirst($key))}}__          | {{$value}}   |
@endforeach
@endcomponent



@component('mail::button', ['url' => env('APP_URL')])
Visit Our Website
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent


