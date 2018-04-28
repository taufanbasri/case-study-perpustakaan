@component('mail::message')
# Halo {{ $member->name }}

Admin kami telah mendaftarkan email Anda ({{ $member->email }}) ke Aplikasi Perpustakaan Online. Untuk login, silahkan kunjungi link berikut:

@component('mail::button', ['url' => url('login')])
  Login
@endcomponent

Login dengan email Anda dan password <strong>{{ $password }}</strong>.


Salam,<br>
{{ config('app.name') }}
@endcomponent
