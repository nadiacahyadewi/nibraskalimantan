<x-mail::message>
# Verifikasi Pendaftaran Akun

Halo! Terima kasih telah mendaftar di Febia Nibras Kalsel.
Untuk menyelesaikan pendaftaran Anda, silakan gunakan kode OTP berikut:

<x-mail::panel>
<div style="font-size: 32px; font-weight: bold; letter-spacing: 5px; text-align: center; color: #E32184;">
{{ $otp }}
</div>
</x-mail::panel>

Kode OTP ini hanya berlaku selama **1 menit**.
Jika Anda tidak merasa melakukan pendaftaran, abaikan email ini.

Terima kasih,<br>
{{ config('app.name') }}
</x-mail::message>
