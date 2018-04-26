<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class UserShouldVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (auth()->check() && !auth()->user()->is_verified) {
            $link = url('auth/resend-verification') . '?email=' . urlencode(auth()->user()->email);

            auth()->logout();

            Session::flash('flash_notification', [
                'level' => 'warning',
                'message' => "Akun anda belum aktif, silahkan klik link verifikasi yang telah dikirim ke email Anda. <a class='alert-link' href='$link'>Kirim Ulang Verifikasi</a>"
            ]);

            return redirect('/login');
        }

        return $response;
    }
}
