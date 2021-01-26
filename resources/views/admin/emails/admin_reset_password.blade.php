@component('mail::message')
# Reset password
Welcome {{ $data['admin']->name }}

@component('mail::button', ['url' => route('admin.reset_password', $data['token'])])
Click here to reset your password
@endcomponent

# Or <br>
Copy this link
<a href="{{ route('admin.reset_password', $data['token']) }}">
    {{ route('admin.reset_password', $data['token']) }}
</a>

Thanks,<br>
Kero
@endcomponent
