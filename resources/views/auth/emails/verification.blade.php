@component('mail::message')
# Halo {{ $user->name }}

Silahkan klik link berikut untuk melakukan aktifasi:

@component('mail::button', ['url' => url('auth/verify', $user->verification_token) . '?email=' . urlencode($user->email)])
Verifikasi
@endcomponent

Salam,<br>
{{ config('app.name') }}
@endcomponent
