@component('mail::message')
# Email Verification

To verify your email click the below button

@component('mail::button', ['url' => route('customer.verify', ['token' => $data['token'], 'email' =>  $data['email']])])
Verify Email
@endcomponent

# Or<br>
 copy and past this url {{ route('customer.verify', ['token' => $data['token'], 'email' =>  $data['email']]) }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
