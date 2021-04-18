@component('mail::message')
# Reset Password 

please click on the button below to change the  password .

@component('mail::button', ['url' => 'http://localhost:4200/responsepwd?token='.$token])
Reset password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
